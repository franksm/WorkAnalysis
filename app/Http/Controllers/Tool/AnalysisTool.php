<?php
namespace App\Http\Controllers\Tool;

class AnalysisTool
{
    private function getCompanyInfo($dbObject){
        $company=$dbObject->company->all('id','company_name','link')->where('id',$dbObject->company_id)->toarray();
        $companyContent=array_pop($company);
        return $companyContent;
    }

    private function formInfoInArray(&$sumColArray,$dbSumCol,$dbObject,$dbName,$ContentName,$Content){
        $sumColArray[$dbSumCol][$dbName][$dbObject->id][$ContentName.'_name']=$Content[$ContentName.'_name'];
        $sumColArray[$dbSumCol][$dbName][$dbObject->id][$ContentName.'_link']=$Content['link'];
    }

    private function formInfo(&$sumColArray,$dbSumCol,$dbObject,$db){
        $dbContent=$this->getCompanyInfo($dbObject);
        $this->formInfoInObject($sumColArray,$dbSumCol,$dbObject,$db['vacancyCol']);
        $this->formInfoInArray($sumColArray,$dbSumCol,$dbObject,$db['vacancyCol'],$db['companyCol'],$dbContent);
    }

    private function judgmentInHash(&$sumColArray,$dbSumCol){
        if (isset($sumColArray[$dbSumCol]['percent'])){
            $sumColArray[$dbSumCol]['percent']++;
        }
        else{
            $sumColArray[$dbSumCol]['percent']=1;
        }
    }

    private function formInfoInObject(&$sumColArray,$dbSumCol,$dbObject,$dbString,$type=true){
        if($type){
            $sumColArray[$dbSumCol][$dbString][$dbObject->id][$dbString.'_name']=$dbObject->vacancy_name;
        }
        else{
            $sumColArray[$dbSumCol][$dbString][$dbObject->id][$dbString.'_name']=$dbObject->company_name;
        }
        $sumColArray[$dbSumCol][$dbString][$dbObject->id][$dbString.'_link']=$dbObject->link;
    }

    public function handleVacancySumCol(&$sumColArray,$dbSumCol,$dbObject,$db){
        $this->judgmentInHash($sumColArray,$dbSumCol);
        $this->formInfo($sumColArray,$dbSumCol,$dbObject,$db);
    }
    
    public function handleCompanySumCol(&$sumColArray,$dbSumCol,$dbObject,$db){
        $this->judgmentInHash($sumColArray,$dbSumCol);
        $this->formInfoInObject($sumColArray,$dbSumCol,$dbObject,$db,false);
    }

    public function hashContentToPercent(&$sumColArray,$selectWorks){
        foreach($sumColArray as $sumColArrayItem => $sumColArrayCount){
            $sumColArray[$sumColArrayItem]['percent']=round($sumColArrayCount['percent']/count($selectWorks)*100,1);
        }
    }

}