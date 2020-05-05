<?php
namespace App\Http\Controllers\api;

class detailFormInfo
{
    private function getCompanyInfo($vacancy){
        $company=$vacancy->company->all('id','company_name','link')->where('id',$vacancy->company_id)->toarray();
        $companyContent=array_pop($company);
        return $companyContent;
    }

    private function vacancyInfo(&$countArray,$vacancyInfo,$vacancy){
        $countArray[$vacancyInfo]['vacancy'][$vacancy->id]['vacancy_name']=$vacancy->vacancy_name;
        $countArray[$vacancyInfo]['vacancy'][$vacancy->id]['vacancy_link']=$vacancy->link;
    }

    private function companyInfo(&$countArray,$vacancyInfo,$vacancy,$companyContent){
        $countArray[$vacancyInfo]['vacancy'][$vacancy->id]['company_name']=$companyContent['company_name'];
        $countArray[$vacancyInfo]['vacancy'][$vacancy->id]['company_link']=$companyContent['link'];
    }

    public function detailFormInfo(&$countArray,$vacancyInfo,$vacancy){
        $companyContent=$this->getCompanyInfo($vacancy);
        $this->companyInfo($countArray,$vacancyInfo,$vacancy,$companyContent);
        $this->vacancyInfo($countArray,$vacancyInfo,$vacancy);
    }
    
}