<?php
namespace App\Http\Controllers\Tool;

use App\Vacancy;
use App\Company;
use App\Resume;

class GetDbObject
{
    public function getResumeDbObject($selectCol,$selectWorks){
        $resumes=Resume::select($selectCol)->find($selectWorks);
        return $resumes;
    }
    public function getVacancyDbObject($selectCol,$selectWorks,$getall=False){
        if($getall){
            $vacancies=Vacancy::all()->find($selectWorks)->toarray();
        }
        else{
            $vacancies=Vacancy::select($selectCol)->find($selectWorks);
        }
        return $vacancies;
    }
    public function getCompanyDbObject($works)
    {
        $vacancies=$this->getVacancyDbObject(['id','company_id'],$works);
        $vacancyArray=[];
        foreach($vacancies as $vacancy){
            $vacancyArray[$vacancy->company_id]=$vacancy->company_id;
        }
        $companies=Company::all()->find($vacancyArray);
        return $companies;
    }
}