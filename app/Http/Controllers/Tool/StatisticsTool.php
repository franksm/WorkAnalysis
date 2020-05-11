<?php
namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Statistics\ComputeCosine;
use App\Http\Controllers\Statistics\AdjustmentMethod;

class StatisticsTool
{
    public function computeCosine($arrMark,$arrAnaly)
    {   
        $computeCosine=new ComputeCosine;
        $strCosine=$computeCosine->getCosine($arrMark,$arrAnaly);
        return $strCosine;
    }
}