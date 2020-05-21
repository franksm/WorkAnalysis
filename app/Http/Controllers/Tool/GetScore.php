<?php
namespace App\Http\Controllers\Tool;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Tool\UseApi;
use App\Http\Controllers\Tool\StatisticsTool;
use App\Http\Controllers\Statistics\StatisticsMethods;
use App\Http\Controllers\Tool\HandleData;
class GetScore
{

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
        foreach($vacancies as $index=>$vacancy){
            $vacanciesVector[$index]['experience']=$score['experience'][$vacancy['claim_experience']];
            $vacanciesVector[$index]['education']=$score['education'][$vacancy['claim_education']];
        }
        return $vacanciesVector;
    }
    
    private function prepareResume($resume){
        $resumeVector=[];
        $StatisticsMethods=new StatisticsMethods();
        $score=$StatisticsMethods->setScore();
        $resumeVector['experience']=$score['experience'][$resume['experience']];
        $resumeVector['education']=$score['education'][$resume['education']];
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

    /*
    *
    *x=z-1/y;
    *x=職缺會變成的數值;
    *y=原始職缺的數值;
    *z=履歷的數值;
    *
    */
    private function hyperbola($prepareVacanciesVector,$prepareResumeVector){
        foreach($prepareVacanciesVector as $index=>$vacancyVector){
            if ($prepareResumeVector['experience']>$vacancyVector['experience']){
                $prepareVacanciesVector[$index]['experience']=$prepareResumeVector['experience']-1/$vacancyVector['experience'];
            }
            if ($prepareResumeVector['education']>$vacancyVector['education']){
                $prepareVacanciesVector[$index]['education']=$prepareResumeVector['education']-1/$vacancyVector['education'];
            }
        }
        return $prepareVacanciesVector;
    }

    public function getScore(&$vacancies,$categories,$tools,$type=null){
        $statisticsTool = new Tool;
        $statisticsMethods = new StatisticsMethods;
        $categoryItem=[];
        $allCategory=[];
        $prepareVacanciesVector= $this->prepareVacancies($vacancies);
        list($resumeTools,$resumeCategories,$resume)=$this->getResume();
        $prepareResumeVector = $this->prepareResume($resume);
        $handleCategories=$statisticsTool->handleData($categories,'vacancy_category',$resumeCategories);
        $handleTools=$statisticsTool->handleData($tools,'vacancy_tool',$resumeTools);
        $prepareVacanciesVector=$this->hyperbola($prepareVacanciesVector,$prepareResumeVector);
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