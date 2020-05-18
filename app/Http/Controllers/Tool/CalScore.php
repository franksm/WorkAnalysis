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
        $expAndEduWeight=[];
        foreach($vacancies as $index=>$vacancy){
            $expAndEduWeight['experience'][$vacancy['claim_experience']]=$vacancy['weight_experience'];
            $expAndEduWeight['education'][$vacancy['claim_education']]=$vacancy['weight_education'];
            $vacanciesVector[$index]['experience']=$vacancy['weight_experience']*$scoreArray['experience'][$vacancy['claim_experience']];
            $vacanciesVector[$index]['education']=$vacancy['weight_education']* $scoreArray['education'][$vacancy['claim_education']];
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
    
    public function calScore(&$vacancies,$categories,$tools,$weight,$type=null){
        $statisticsTool=new StatisticsTool;
        $categoryItem=[];
        $allCategory=[];
        list($resumeTools,$resumeCategories,$resume)=$this->getResume();
        $handleCategories=$statisticsTool->handleData($categories,'vacancy_category',$resumeCategories);
        $handleTools=$statisticsTool->handleData($tools,'vacancy_tool',$resumeTools);
        list($prepareVacanciesVector,$expAndEduWeight) = $this->prepareVacancies($weight,$vacancies);
        $prepareResumeVector = $this->prepareResume($weight,$resume,$expAndEduWeight);
        $prepareVacanciesVector[]=$prepareResumeVector;
        $vacanciesVectorCount=count($prepareVacanciesVector);
        foreach($prepareVacanciesVector as $index => $prepareVacancyVector){
            $prepareVacancyVector['experience']/=$vacanciesVectorCount;
            $prepareVacancyVector['education']/=$vacanciesVectorCount;
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