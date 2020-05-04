<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\algorithm\CosineSimilarity;
use App\Http\Controllers\api\processVacancyResumeController;

class weightsController extends Controller
{
    private function getAllinfo(){
        $urlApi = "http://laravel.test/api/getVacancyId";
        $id = json_decode(file_get_contents($urlApi));
        $search = "";
        foreach($id as $work){
            $search .= "works[]=".$work->id."&";
        }
        $urlApi = "http://laravel.test/api/get_vacancies?".$search;
        $Vacancies = json_decode(file_get_contents($urlApi),true);
        $claim=new processVacancyResumeController;
        $claim->processClaimInfo($Vacancy,"claimEducation");
        
        $urlApi = "http://laravel.test/api/get_categories?".$search;
        $Categories = json_decode(file_get_contents($urlApi),true);
        $urlApi = "http://laravel.test/api/get_tools?".$search;
        $Tools = json_decode(file_get_contents($urlApi),true);

    }

    
}
