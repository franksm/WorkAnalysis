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