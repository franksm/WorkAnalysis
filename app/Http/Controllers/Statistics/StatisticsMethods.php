<?php
namespace App\Http\Controllers\Statistics; 

class StatisticsMethods
{
    public function avergeValue($array){
        $arrayCount=count($array);
        $arraySum=array_sum($array);
        $averge=$arraySum/$arrayCount;
        return $averge;
    }
    public function setScore(){
        $Eductions = ['不拘'=>1,'高中'=>2,'專科'=>3,'大學'=>4,'碩士'=>5,'博士'=>6];
        $Experiences = ['不拘'=>1,'1年'=>2,'2年'=>3,'3年'=>4,'4年'=>5,'5年'=>6,'6年'=>7,'7年'=>8,'8年'=>9,'9年'=>10,'10年'=>11];
        return ['educations'=>$Eductions,'experiences'=>$Experiences];
    }
    public function computePercent($benchMark,$selfNumber){
        if($benchMark<$selfNumber){
            $percent=100;
        }
        else{
            $proportion=$selfNumber/$benchMark;
            $percent=$proportion*100;
        }
        return (int)$percent;
    }
    public function setSimilar($benchSet,$selfSet){
        $intersectCount=count(array_intersect($benchSet,$selfSet));
        $mergeCount=count((array_merge($benchSet,$selfSet)));
        $setSimilarity=$intersectCount/$mergeCount;
        $setPercent=$setSimilarity*100;
        return (int)$setPercent;
    }

    public function meanNormalization($targetNumber,$array,$max,$min){
        $averge=$this->avergeValue($array);
        $normalization=(($targetNumber-$averge)/($max-$min));
        return $normalization;
    }

    public function normalization($targetNumber,$max,$min){
        $normalization=(($targetNumber-$min)/($max-$min));
        return $normalization;
    }
}