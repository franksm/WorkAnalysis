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
    
    public function computePercent($selfNumber,$benchMark){
        if($benchMark<$selfNumber){
            $percent=100;
        }
        else{
            if($selfNumber==0 or $benchMark==0){
                return 0;
            }
            $proportion=$selfNumber/$benchMark;
            $percent=$proportion*100;
        }
        return (int)$percent;
    }

    public function setSimilar($selfSet,$benchSet){
        $intersectCount=count(array_intersect($selfSet,$benchSet));
        $mergeCount=count((array_merge($selfSet,$benchSet)));
        if (count($benchSet)==0){
            return 100;
        }
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