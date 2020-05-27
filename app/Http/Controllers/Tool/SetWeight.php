<?php
namespace App\Http\Controllers\Tool;
use App\Http\Controllers\Tool\UseApi;
class SetWeight
{
    private function checkInHash(&$weight,$weightType,$weightItem){
        if(isset($weight[$weightType][$weightItem]) and $weightItem!="不拘"){
            $weight[$weightType][$weightItem]++;
        }
        else if ($weightItem=="不拘"){
            $weight[$weightType][$weightItem]=1;
        }
        else{
            $weight[$weightType][$weightItem]=1;
        }
    }

    private function checkNull($item,&$count){
        if($item!="不拘"){
            $count++;
        }
    }

    private function setWeight(&$weight,$count){
        foreach($weight as $weightType=>$weightItem){
            foreach($weightItem as $weightCountKey=>$weightCount){
                $weight[$weightType][$weightCountKey]=round($weight[$weightType][$weightCountKey]/$count[$weightType],2);
            }
        }
    }

    private function setCount(&$count){
        $count['category']=0;
        $count['tool']=0;
        $count['education']=0;
        $count['experience']=0;
    }
    
    public function setVacancItemWeight($vacancies){
        $weight=[];
        $count=[];
        $this->setCount($count);
        foreach ($vacancies as $vacancy){
            $this->checkInHash($weight,'education',$vacancy['claim_education']);
            $this->checkInHash($weight,'experience',$vacancy['claim_experience']);
            foreach(array_column($vacancy['category'],'vacancy_category') as $category){
                $this->checkInHash($weight,'category',$category);
                $this->checkNull($category,$count['category']);
            }
            foreach(array_column($vacancy['tool'],'vacancy_tool') as $tool){
                $this->checkInHash($weight,'tool',$tool);
                $this->checkNull($tool,$count['tool']);
            }
            $this->checkNull($vacancy['claim_experience'],$count['experience']);
            $this->checkNull($vacancy['claim_education'],$count['education']);
        }
        $this->setWeight($weight,$count);
        return $weight;
    }

}