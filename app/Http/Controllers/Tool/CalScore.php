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
    private function getResume(){
            $search=['id'=>Auth::id()];
            $useApi = new UseApi();
            $resumeTools = $useApi->CallApi('GET','api/ResumeTool',$search);
            $resumeCategories = $useApi->CallApi('GET','api/ResumeCategory',$search);
            $resume = $useApi->CallApi('GET','api/Resume',$search);
            return [$resumeTools,$resumeCategories,$resume];
    }
    private function prepareVacancies($vacancies,$categories,$tools){
        $vacanciesVector=[];
        foreach($vacancies as $index=>$vacancy){
            $categorySum=0;
            $toolSum=0;
            $vacanciesVector[$index]['experience']=$vacancy['weight_experience'];
            $vacanciesVector[$index]['education']=$vacancy['weight_education'];
            foreach($categories[$vacancy['id']] as $key=>$category){
                $categorySum+=$category['weight'];
            }
            foreach($tools[$vacancy['id']] as $tool){
                $toolSum+=$tool['weight'];
            }
            $vacanciesVector[$index]['category']=$categorySum;
            $vacanciesVector[$index]['tool']=$toolSum;
        }
        return $vacanciesVector;
    }
    private function chechInWeight($weight,$resume){
        $weightValue=0;
        if(isset($weight[$resume])){
            $weightValue=$weight[$resume];
        }
        else{
            $weightValue=min($weight);
        }
        return $weightValue;
    }
    private function prepareResume($resume,$weight,$resumeTools,$resumeCategories){
        $resumeVector=[];
        $resumeVector['experience']=$this->chechInWeight($weight['experience'],$resume['experience']);
        $resumeVector['education']=$this->chechInWeight($weight['education'],$resume['education']);
        $categorySum=0;
        $toolSum=0;
        foreach ($resumeTools as $resumeTool) {
            $toolSum+=$this->chechInWeight($weight['tool'],$resumeTool);
        }
        foreach ($resumeCategories as $resumeCategory) {
            $categorySum+=$this->chechInWeight($weight['category'],$resumeCategory);
        }
        $resumeVector['tool']=$toolSum;
        $resumeVector['category']=$categorySum;
        return $resumeVector;
    }
    public function calScore(&$vacancies,$categories,$tools,$weight)
        {
            $statisticsTool=$this->getStatisticsTool();
            list($resumeTools,$resumeCategories,$resume)=$this->getResume();
            $preparationVacanciesVector = $this->prepareVacancies($vacancies,$categories,$tools);
            $preparationResumeVector = $this->prepareResume($resume,$weight,$resumeTools,$resumeCategories);
            $sortVacancy=[];
            foreach($preparationVacanciesVector as $key=>$vacancyVector){
                $score=$statisticsTool->computeCosine($vacancyVector,$preparationResumeVector);
                $sortVacancy[$key]=$score;
            }
            arsort($sortVacancy);
            return $sortVacancy;
        }
}