<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\similarityCalculationKernel;

class vacancyResumeWeightsController extends Controller
{
    private function infoDefinition(){
        $claimEducationArray=["高中"=>1,"專科"=>1,"大學"=>2,"碩士"=>3,"博士"=>3];
        $claimExperienceArray=["無經歷"=>0,"不拘"=>0,"一年"=>1,"二年"=>2,"三年"=>3,"四年"=>4,"五年"=>5,"六年"=>6,"七年"=>7,"八年"=>8,"九年"=>9,"十年"=>10];
        return ["claimEducation"=>$claimEducationArray,"claimExperience"=>$claimExperienceArray];
    }
    private function i(){
        
    }
    private function process(){
        
    }
}
