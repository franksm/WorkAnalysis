<?php
namespace App\Http\Controllers\Math; 

class ComputePercent
{
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
}