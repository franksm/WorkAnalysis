<?php
namespace App\Http\Controllers\Tool;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Tool\UseApi;
use App\Http\Controllers\Tool\StatisticsTool;
use App\Http\Controllers\Statistics\StatisticsMethods;
use App\Http\Controllers\Tool\HandleData;
class CalScore
{
    
    private function setScore(){
        $Eductions = ['不拘'=>1,'高中'=>2,'專科'=>3,'大學'=>5,'碩士'=>8,'博士'=>13];
        $Experiences = ['不拘'=>1,'1年'=>2,'2年'=>3,'3年'=>5,'4年'=>8,'5年'=>13,'6年'=>21,'7年'=>34,'8年'=>55,'9年'=>89,'10年'=>144];
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
        $expAndEduWeight=[];
        foreach($vacancies as $index=>$vacancy){
            $expAndEduWeight['experience'][$vacancy['claim_experience']]=$vacancy['weight_experience'];
            $expAndEduWeight['education'][$vacancy['claim_education']]=$vacancy['weight_education'];
            $vacanciesVector[$index]['experience']=$vacancy['weight_experience']*$scoreArray['experience'][$vacancy['claim_experience']];
            $vacanciesVector[$index]['education']=$vacancy['weight_education']*$scoreArray['education'][$vacancy['claim_education']];
        }
        return [$vacanciesVector,$expAndEduWeight];
    }
    
    private function prepareResume($weight,$resume,$prepareVacanciesVector){
        $resumeVector=[];
        $scoreArray=$this->setScore();
        $minExp=min($prepareVacanciesVector['experience']);
        $minEdu=min($prepareVacanciesVector['education']);
        if (isset($prepareVacanciesVector['experience'][$resume['experience']])){
            $resumeVector['experience']=$prepareVacanciesVector['experience'][$resume['experience']]*$scoreArray['experience'][$resume['experience']];   
        }
        else{
            $resumeVector['experience']=$minExp*$scoreArray['experience'][$resume['experience']];   
        }
        if (isset($prepareVacanciesVector['education'][$resume['education']])){
            $resumeVector['education']=$prepareVacanciesVector['education'][$resume['education']]*$scoreArray['education'][$resume['education']];
        }
        else{
            $resumeVector['education']=$minEdu*$scoreArray['education'][$resume['education']];
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
    public function calScore(&$vacancies,$categories,$tools,$weight,$type=null){
        $statisticsTool = new Tool;
        $statisticsMethods = new StatisticsMethods;
        $categoryItem=[];
        $allCategory=[];
        list($resumeTools,$resumeCategories,$resume)=$this->getResume();
        $handleCategories=$statisticsTool->handleData($categories,'vacancy_category',$resumeCategories);
        $handleTools=$statisticsTool->handleData($tools,'vacancy_tool',$resumeTools);
        list($prepareVacanciesVector,$expAndEduWeight) = $this->prepareVacancies($weight,$vacancies);
        $prepareResumeVector = $this->prepareResume($weight,$resume,$expAndEduWeight);
        $prepareVacanciesVector[]=$prepareResumeVector;
        $normalizationInfo=$this->getNormalizationNeedInfo($prepareVacanciesVector);
        $vacanciesVectorCount=count($prepareVacanciesVector);
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
            $score=$statisticsTool->computeCosine($vacancyVector,$prepareResumeVector,$type);
            $sortVacancy[$key]=$score;
        }
        arsort($sortVacancy);
        return $sortVacancy;
    }

}