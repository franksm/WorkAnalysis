<?php
namespace App\Http\Controllers\Statistics;
use App\Http\Controllers\Statistics\StatisticsMethods;
class AdjustmentMethod
{
    public function adjustmentData($adjustmentArray,$experienceArray,$educationArray){
        $methods=new StatisticsMethods;
        $expDisparity=$methods->avergeValue($experienceArray);
        $eduDisparity=$methods->avergeValue($educationArray);
        $experienceMax=max($experienceArray);
        $educationMax=max($educationArray);
        $experienceMin=min($experienceArray);
        $educationMin=min($educationArray);
        foreach($adjustmentArray as $key=>$adjustment){
            $experience=$adjustment['Multiply'][0];
            $education=$adjustment['Multiply'][1];
            $adjustmentArray[$key]['Multiply'][0]=$methods->meanNormalization($experience,$experienceArray,$experienceMax,$experienceMin);
            $adjustmentArray[$key]['Multiply'][1]=$methods->meanNormalization($education,$educationArray,$educationMax,$educationMin);
        }
        return ['readyData'=>$adjustmentArray,'resumeExperience'=>end($experienceArray)-$expDisparity,'resumeEducation'=>end($educationArray)-$eduDisparity];
    }
}