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
            $weight[$weightType][$weightItem]=null;
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
    
    public function setVacancItemWeight($vacancies){
        $weight=[];
        $count=[];
        $count['category']=0;
        $count['tool']=0;
        foreach ($vacancies as $vacancy){
            foreach(array_column($vacancy['category'],'vacancy_category') as $category){
                $this->checkInHash($weight,'category',$category);
            }
            foreach(array_column($vacancy['tool'],'vacancy_tool') as $tool){
                $this->checkInHash($weight,'tool',$tool);
            }
        }
        return $weight;
    }

}