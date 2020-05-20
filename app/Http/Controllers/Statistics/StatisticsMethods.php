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
        $Eductions = ['不拘'=>0,'高中'=>1,'專科'=>2,'大學'=>3,'碩士'=>4,'博士'=>5];
        $Experiences = ['不拘'=>0,'1年'=>1,'2年'=>2,'3年'=>3,'4年'=>4,'5年'=>5,'6年'=>6,'7年'=>7,'8年'=>8,'9年'=>9,'10年'=>10];
        return ['education'=>$Eductions,'experience'=>$Experiences];
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
            return  $targetNumber-$averge;
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