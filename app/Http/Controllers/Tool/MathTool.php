<?php
namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Math\ComputeCosine;
use App\Http\Controllers\Math\ComputePercent;
use App\Http\Controllers\Math\ComputeSetSimilar;
use App\Http\Controllers\Math\AdjustmentData;
use App\Http\Controllers\Math\SetVector;

class MathTool
{
    public function computeCosine($sumMark,$sumAnaly,$sumBoth,$multiplyMark,$multiplyAnaly)
    {   
        $computeCosine=new ComputeCosine;
        $strCosine=$computeCosine->getCosine($sumMark,$sumAnaly,$sumBoth,$multiplyMark,$multiplyAnaly);
        return $strCosine;
    }
    public function getPercent($benchMark,$selfNumber){
        $computePercent=new ComputePercent;
        $percent=$computePercent->computePercent($benchMark,$selfNumber);
        return $percent;
    }
    public function getSetSimilar($benchSet,$selfSet){
        $computePercent=new ComputeSetSimilar;
        $setPercent=$computePercent->computeSetSimilar($benchSet,$selfSet);
        return $setPercent;
    }
    public function adjustmentData(&$adjustmentArray){
        $adjustment=new AdjustmentData;
        $adjustment->adjustmentData($adjustmentArray);
    }
}