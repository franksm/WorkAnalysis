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
            return $targetNumber-$averge;
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