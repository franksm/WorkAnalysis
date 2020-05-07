<?php
namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Math\ComputeCosine;
use App\Http\Controllers\Math\ComputePercent;
class MathTool
{
    public function setVector($vacancy,$resume,&$vacancyVector,&$resumeVector,&$bothlenVector=[]){
        $bothlenVector[]=count(array_intersect($vacancy,$resume));
        $vacancyVector[]=count($vacancy);
        $resumeVector[]=count($resume);
    }
    public function computeVector($vacancyVector,$resumeVector,$bothlenVector)
    {   
        $strCosine=ComputeCosine::getCosine($vacancyVector,$resumeVector,$bothlenVector);
        return $strCosine;
    }
    public function getPercent($benchMark,$selfNumber){
        $computePercent=new ComputePercent;
        $percent=$computePercent->computePercent($benchMark,$selfNumber);
        return $percent;
    }
}