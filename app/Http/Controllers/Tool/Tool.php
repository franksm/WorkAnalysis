<?php
namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Statistics\CosineStatistics;
use App\Http\Controllers\Statistics\PearsonCorrelationCoefficient;
use App\Http\Controllers\Tool\HandleData;

class Tool
{
    public function computeCosine($arrMark,$arrAnaly)
    {   
        $computeCosine=new CosineStatistics;
        $strCosine=$computeCosine->getCosine($arrMark,$arrAnaly);
        return $strCosine;
    }
    public function pearson($adjustmentArray)
    {   
        $pearson=new PearsonCorrelationCoefficient;
        $prepareData=$pearson->pearson($adjustmentArray);
        return $prepareData;
    }
    public function handleData($field,$fieldType,$resumeField)
    {   
        $handle=new HandleData;
        $handleData=$handle->handleData($field,$fieldType,$resumeField);
        return $handleData;
    }
}