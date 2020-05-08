<?php
namespace App\Http\Controllers\Tool;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Tool\UseApi;
use App\Http\Controllers\Tool\StatisticsTool;

class CalScore
{
    private function getStatisticsTool(){
        $statisticsTool=new StatisticsTool;
        return $statisticsTool;
    }
    private function setScore(){
        $Eductions = ['不拘'=>1,'高中'=>2,'專科'=>3,'大學'=>4,'碩士'=>5,'博士'=>6];
        $Experiences = ['不拘'=>1,'1年'=>2,'2年'=>3,'3年'=>4,'4年'=>5,'5年'=>6,'6年'=>7,'7年'=>8,'8年'=>9,'9年'=>10,'10年'=>11];
        return ['educations'=>$Eductions,'experiences'=>$Experiences];
    }
    private function getResume(){
            $search=['id'=>Auth::id()];
            $useApi = new UseApi();
            $resumeTools = $useApi->CallApi('GET','api/ResumeTool',$search);
            $resumeCategories = $useApi->CallApi('GET','api/ResumeCategory',$search);
            $resume = $useApi->CallApi('GET','api/Resume',$search);
            return [$resumeTools,$resumeCategories,$resume];
    }
    private function prepareData($vacancies,$categories,$tools,$resume,$resumeTools,$resumeCategories){
        $score = $this->setScore();
        $vacancyInfo=[];
        $vacancyExperience=[];
        $vacancyEducation=[];
        foreach($vacancies as $key=>$vacancy){
            $id=$vacancy['id'];
            $vacancyCategory=array_column($categories[$id],'vacancy_category');
            $vacancyTool=array_column($tools[$id],'vacancy_tool');
            $vacancyExperience[]=$score['experiences'][$vacancy['claim_experience']];
            $vacancyEducation[]=$score['educations'][$vacancy['claim_education']];
            $vacancyInfo[$key]['Multiply']=[$score['experiences'][$vacancy['claim_experience']],$score['educations'][$vacancy['claim_education']]];
            $vacancyInfo[$key]['Sum']=[count($vacancyTool),count($vacancyCategory)];
            $vacancyInfo[$key]['Both']=[count(array_intersect($vacancyTool,$resumeTools)),count(array_intersect($vacancyCategory,$resumeCategories))];
        }
        $vacancyExperience[]=$score['experiences'][$resume['experience']];
        $vacancyEducation[]=$score['educations'][$resume['education']];
        return ['info'=>$vacancyInfo,'experience'=>$vacancyExperience,'education'=>$vacancyEducation];
    }
    public function calScore(&$vacancies,$categories,$tools)
        {
            $statisticsTool=$this->getStatisticsTool();
            list($resumeTools,$resumeCategories,$resume)=$this->getResume();
            $resumeSum=[count($resumeTools),count($resumeCategories)];
            $sortVacancy=[];
            $preparationData = $this->prepareData($vacancies,$categories,$tools,$resume,$resumeTools,$resumeCategories);
            $readyData = $statisticsTool->adjustmentData($preparationData['info'],$preparationData['experience'],$preparationData['education']);
            $resumeMultiply=[$readyData['resumeExperience'],$readyData['resumeEducation']];
            foreach($readyData['readyData'] as $key=>$vacancy){
                $score=$statisticsTool->computeCosine($vacancy['Sum'],$resumeSum,$vacancy['Both'],$vacancy['Multiply'],$resumeMultiply);
                $sortVacancy[$key]=$score;
            }
            arsort($sortVacancy);
            return $sortVacancy;
        }
}