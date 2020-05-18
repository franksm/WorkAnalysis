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
        return $percent;
    }

    public function meanNormalization($targetNumber,$max,$min,$array){
        $averge=$this->avergeValue($array);
        if (($max-$min)==0){
            $max++;
        }
        $normalization=(($targetNumber-$averge)/($max-$min));
        return $normalization;
    }

    public function normalization($targetNumber,$max,$min){
        if(($max-$min)==0){
            return $targetNumber-$min;
        }
        $normalization=(($targetNumber-$min)/($max-$min));
        return $normalization;
    }
}