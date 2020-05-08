<?php
namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Statistics\ComputeCosine;
use App\Http\Controllers\Statistics\AdjustmentMethod;

class StatisticsTool
{
    public function computeCosine($sumMark,$sumAnaly,$sumBoth,$multiplyMark,$multiplyAnaly)
    {   
        $computeCosine=new ComputeCosine;
        $strCosine=$computeCosine->getCosine($sumMark,$sumAnaly,$sumBoth,$multiplyMark,$multiplyAnaly);
        return $strCosine;
    }
    public function adjustmentData($adjustmentArray,$experienceArray,$educationArray){
        $adjustment=new AdjustmentMethod;
        return $adjustment->adjustmentData($adjustmentArray,$experienceArray,$educationArray);
    }

}