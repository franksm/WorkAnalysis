<?php
namespace App\Http\Controllers\api;

use App\Vacancy;

class GetVacancyData
{
    public function getVacancyData($selectCol,$selectWorks){
        $Vacancies=Vacancy::select($selectCol)->find($selectWorks);
        return $Vacancies;
    }
}