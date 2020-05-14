<?php
namespace App\Http\Controllers\Statistics;
use App\Http\Controllers\Statistics\PearsonCorrelationCoefficient;
class PearsonCorrelationCoefficient
{
    public function pearson($adjustmentArray){
        $methods=new StatisticsMethods;
        $adjustmentArrayLen=count($adjustmentArray);
        $adjustment=[];
        foreach(end($adjustmentArray) as $adjustmentKey=>$adjustmentValue){
            $adjustment[$adjustmentKey]=(array_sum(array_column($adjustmentArray,$adjustmentKey))/$adjustmentArrayLen);
        }
        foreach($adjustmentArray as $arrayItemIndex=>$arrayItem){
            foreach($arrayItem as $adjustmentItemIndex=>$adjustmentItem){
                $adjustmentArray[$arrayItemIndex][$adjustmentItemIndex]=round(($adjustmentArray[$arrayItemIndex][$adjustmentItemIndex]-$adjustment[$adjustmentItemIndex]),2);
            }
        }
        return $adjustmentArray;
    }
}