<?php
namespace App\Http\Controllers\Math; 

class AdjustmentData
{
    private function handleData($adjustmentArray){
        $adjustmentLen=count($adjustmentArray);
        $adjustmentSum=array_sum($adjustmentArray);
        $disparity=$adjustmentSum/$adjustmentLen;
        return $disparity;
    }
    public function adjustmentData(&$adjustmentArray){
        $disparity=$this->handleData($adjustmentArray);
        foreach($adjustmentArray as $arrayIndex=>$adjustment){
            $adjustmentArray[$arrayIndex]-=$disparity;
        }
    }
}