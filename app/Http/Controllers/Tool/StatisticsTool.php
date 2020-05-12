<?php
namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Statistics\ComputeCosine;
use App\Http\Controllers\Statistics\AdjustmentMethod;
use App\Http\Controllers\Tool\HandleData;

class StatisticsTool
{
    public function computeCosine($arrMark,$arrAnaly)
    {   
        $computeCosine=new ComputeCosine;
        $strCosine=$computeCosine->getCosine($arrMark,$arrAnaly);
        return $strCosine;
    }
    public function adjustmentMethod($adjustmentArray)
    {   
        $adjustmentMethod=new AdjustmentMethod;
        $prepareData=$adjustmentMethod->adjustmentData($adjustmentArray);
        return $prepareData;
    }
    public function handleData($field,$fieldType,$resumeField)
    {   
        $handle=new HandleData;
        $handleData=$handle->handleData($field,$fieldType,$resumeField);
        return $handleData;
    }
}