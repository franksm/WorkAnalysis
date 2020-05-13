<?php
namespace App\Http\Controllers\Tool;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Tool\UseApi;
use App\Http\Controllers\Tool\StatisticsTool;
use App\Http\Controllers\Tool\HandleData;
use Phpml\Math\Statistic\Correlation;
class CalScore
{
    
    private function setScore(){
        $Eductions = ['不拘'=>1,'高中'=>2,'專科'=>2,'大學'=>3,'碩士'=>4,'博士'=>5];
        $Experiences = ['不拘'=>1,'1年'=>2,'2年'=>3,'3年'=>4,'4年'=>5,'5年'=>6,'6年'=>7,'7年'=>8,'8年'=>9,'9年'=>10,'10年'=>11];
        return ['education'=>$Eductions,'experience'=>$Experiences];
    }
    private function getResume(){
            $search=['id'=>Auth::id()];
            $useApi = new UseApi();
            $resumeTools = $useApi->CallApi('GET','api/ResumeTool',$search);
            $resumeCategories = $useApi->CallApi('GET','api/ResumeCategory',$search);
            $resume = $useApi->CallApi('GET','api/Resume',$search);
            return [$resumeTools,$resumeCategories,$resume];
    }
    private function prepareVacancies($weight,$vacancies){
        $vacanciesVector=[];
        $scoreArray=$this->setScore();
        foreach($vacancies as $index=>$vacancy){
            $vacanciesVector[$index]['experience']=$scoreArray['experience'][$vacancy['claim_experience']];
            $vacanciesVector[$index]['education']=$scoreArray['education'][$vacancy['claim_education']];
        }
        return $vacanciesVector;
    }
    
    private function prepareResume($weight,$resume){
        $resumeVector=[];
        $scoreArray=$this->setScore();
        $resumeVector['experience']=$scoreArray['experience'][$resume['experience']];
        $resumeVector['education']=$scoreArray['education'][$resume['education']];
        return $resumeVector;
    }
    
    public function calScore(&$vacancies,$categories,$tools,$weight){
        $statisticsTool=new StatisticsTool;
        $categoryItem=[];
        $allCategory=[];
        list($resumeTools,$resumeCategories,$resume)=$this->getResume();
        $handleCategories=$statisticsTool->handleData($categories,'vacancy_category',$resumeCategories);
        $handleTools=$statisticsTool->handleData($tools,'vacancy_tool',$resumeTools);
        $preparationResumeVector = $this->prepareResume($weight,$resume);
        $preparationVacanciesVector = $this->prepareVacancies($weight,$vacancies);
        $preparationVacanciesVector[]=$preparationResumeVector;
        $prepareData=$statisticsTool->adjustmentMethod($preparationVacanciesVector);
        foreach($prepareData as $index=>$prepareDataValue){
            $prepareData[$index]=array_merge($prepareData[$index],$handleTools[$index],$handleCategories[$index]);
        }
        
        $preparationResumeVector=array_pop($prepareData);
        $sortVacancy=[];
        foreach($prepareData as $key=>$vacancyVector){
            $score=$statisticsTool->computeCosine($vacancyVector,$preparationResumeVector);
            $sortVacancy[$key]=$score;
        }
        
        arsort($sortVacancy);
        return $sortVacancy;
    }
}