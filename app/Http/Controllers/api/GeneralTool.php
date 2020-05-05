<?php
namespace App\Http\Controllers\api;

use App\Vacancy;

class GeneralTool
{
    public function getVacancyData($selectCol,$selectWorks){
        $Vacancies=Vacancy::select($selectCol)->find($selectWorks);
        return $Vacancies;
    }
    public function getCompanyInfo($works)
    {
        $Vacancies=$this->getVacancyData(Vacancy,['id','company_id'],$works);
        $vacancyArray=[];
        foreach($Vacancies as $Vacancy){
            $vacancyArray[$Vacancy->company_id]=$Vacancy->company_id;
        }
        $Companies=Company::all()->find($vacancyArray);
        return $Companies;
    }
}