<?php
namespace App\Http\Controllers\Tool;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Tool\UseApi;
use App\Http\Controllers\Tool\StatisticsTool;
use App\Http\Controllers\Statistics\StatisticsMethods;
use App\Http\Controllers\Tool\HandleData;
class GetScore
{
<<<<<<< HEAD:app/Http/Controllers/Tool/CalScore.php
    
    private function setScore(){
        $Eductions = ['不拘'=>0,'高中'=>1,'專科'=>2,'大學'=>3,'碩士'=>4,'博士'=>5];
        $Experiences = ['不拘'=>0,'1年'=>1,'2年'=>2,'3年'=>3,'4年'=>4,'5年'=>5,'6年'=>6,'7年'=>7,'8年'=>8,'9年'=>9,'10年'=>10];
        return ['education'=>$Eductions,'experience'=>$Experiences];
    }
=======
>>>>>>> dimensions_calculated_dispersion:app/Http/Controllers/Tool/GetScore.php

    private function getResume(){
            $search=['id'=>Auth::id()];
            $useApi = new UseApi();
            $resumeTools = $useApi->CallApi('GET','api/ResumeTool',$search);
            $resumeCategories = $useApi->CallApi('GET','api/ResumeCategory',$search);
            $resume = $useApi->CallApi('GET','api/Resume',$search);
            return [$resumeTools,$resumeCategories,$resume];
    }

    private function prepareVacancies($vacancies){
        $vacanciesVector=[];
        $StatisticsMethods=new StatisticsMethods();
        $score=$StatisticsMethods->setScore();
        $expAndEduWeight=[];
        foreach($vacancies as $index=>$vacancy){
            $expAndEduWeight['experience'][$vacancy['claim_experience']]=$vacancy['weight_experience'];
            $expAndEduWeight['education'][$vacancy['claim_education']]=$vacancy['weight_education'];
            $vacanciesVector[$index]['experience']=$vacancy['weight_experience']*$score['experience'][$vacancy['claim_experience']];
            $vacanciesVector[$index]['education']=$vacancy['weight_education']*$score['education'][$vacancy['claim_education']];
        }
        return [$vacanciesVector,$expAndEduWeight];
    }
    
    private function prepareResume($resume,$prepareVacanciesVector){
        $resumeVector=[];
        $StatisticsMethods=new StatisticsMethods();
        $score=$StatisticsMethods->setScore();
        $minExp=min($prepareVacanciesVector['experience']);
        $minEdu=min($prepareVacanciesVector['education']);
        if (isset($prepareVacanciesVector['experience'][$resume['experience']])){
            $resumeVector['experience']=$prepareVacanciesVector['experience'][$resume['experience']]*$score['experience'][$resume['experience']];   
        }
        else{
            $resumeVector['experience']=$minExp*$score['experience'][$resume['experience']];   
        }
        if (isset($prepareVacanciesVector['education'][$resume['education']])){
            $resumeVector['education']=$prepareVacanciesVector['education'][$resume['education']]*$score['education'][$resume['education']];
        }
        else{
            $resumeVector['education']=$minEdu*$score['education'][$resume['education']];
        }
        return $resumeVector;
    }

    private function getNormalizationNeedInfo($prepareVacanciesVector){
        $experiences=array_column($prepareVacanciesVector,'experience');
        $eductions=array_column($prepareVacanciesVector,'education');
        $maxExp=max($experiences);
        $minExp=min($experiences);
        $maxEdu=max($eductions);
        $minEdu=min($eductions);
        return ['maxExp'=>$maxExp,'minExp'=>$minExp,'maxEdu'=>$maxEdu,'minEdu'=>$minEdu];
    }

    public function getScore(&$vacancies,$categories,$tools,$type=null){
        $statisticsTool = new Tool;
        $statisticsMethods = new StatisticsMethods;
        $categoryItem=[];
        $allCategory=[];
        list($resumeTools,$resumeCategories,$resume)=$this->getResume();
        $handleCategories=$statisticsTool->handleData($categories,'vacancy_category',$resumeCategories);
        $handleTools=$statisticsTool->handleData($tools,'vacancy_tool',$resumeTools);
        list($prepareVacanciesVector,$expAndEduWeight) = $this->prepareVacancies($vacancies);
        $prepareResumeVector = $this->prepareResume($resume,$expAndEduWeight);
        $prepareVacanciesVector[]=$prepareResumeVector;
        $normalizationInfo=$this->getNormalizationNeedInfo($prepareVacanciesVector);
        foreach($prepareVacanciesVector as $index => $prepareVacancyVector){
            $prepareVacancyVector['experience']=$statisticsMethods->normalization($prepareVacancyVector['experience'],$normalizationInfo['maxExp'],$normalizationInfo['minExp']);
            $prepareVacancyVector['education']=$statisticsMethods->normalization($prepareVacancyVector['education'],$normalizationInfo['maxEdu'],$normalizationInfo['minEdu']);
            $prepareVacanciesVector[$index]=array_merge($prepareVacancyVector,$handleTools[$index],$handleCategories[$index]);
        }
        if ($type=='Pearson'){
            $prepareData=$statisticsTool->pearson($prepareVacanciesVector);
        }
        else{
            $prepareData=$prepareVacanciesVector;
        }
        $prepareResumeVector=array_pop($prepareData);
        $sortVacancy=[];
        foreach($prepareData as $key=>$vacancyVector){
            $score=$statisticsTool->computeCosine($vacancyVector,$prepareResumeVector);
            $sortVacancy[$key]=$score;
        }
        arsort($sortVacancy);
        return $sortVacancy;
    }

}