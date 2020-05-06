<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Tool\AnalysisTool;
use App\Http\Controllers\Tool\GetDbObject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalysisWorkController extends Controller
{
    private function getAnalysisTool(){
        $analysisTool=new AnalysisTool;
        return $analysisTool;
    }
    private function getGetDbObject(){
        $getDbObject=new GetDbObject;
        return $getDbObject;
    }
    /**
     * @OA\GET(
     *     path="/api/categoryCount",
     *     tags={"職缺資訊"},
     *     summary="取得種類統計分析資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getCategoryCount(Request $request)
    {
        $works=$request->works;
        $analysisTool=$this->getAnalysisTool();
        $getDbObject=$this->getGetDbObject();
        $vacancies=$getDbObject->getVacancyDbObject(['id','vacancy_name','company_id','link'],$works);
        $categoryCount=[];
        foreach($vacancies as $vacancy){
            $category=$vacancy->category->toarray();
            foreach($category as $categoryItem){
                $analysisTool->handleVacancySumCol($categoryCount,$categoryItem['vacancy_category'],$vacancy,['vacancyCol'=>'vacancy','companyCol'=>'company']);
            }
        }
        $analysisTool->hashContentToPercent($categoryCount,$works);
        return $categoryCount;
    }

    /**
     * @OA\GET(
     *     path="/api/claimEducationCount",
     *     tags={"職缺資訊"},
     *     summary="取得需求學歷分析資訊",

     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getVacancyClaimEducationCount(Request $request)
    {
        $works=$request->works;
        $analysisTool=$this->getAnalysisTool();
        $getDbObject=$this->getGetDbObject();
        $vacancies=$getDbObject->getVacancyDbObject(['id','vacancy_name','claim_education','company_id','link'],$works);
        $claimEducationCount=[];
        foreach($vacancies as $vacancy){
            $analysisTool->handleVacancySumCol($claimEducationCount,$vacancy->claim_education,$vacancy,['vacancyCol'=>'vacancy','companyCol'=>'company']);
        }
        $analysisTool->hashContentToPercent($claimEducationCount,$works);
        return $claimEducationCount;
    }

    /**
     * @OA\GET(
     *     path="/api/claimExperienceCount",
     *     tags={"職缺資訊"},
     *     summary="取得工作經歷分析資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getVacancyClaimExperienceCount(Request $request)
    {
        $works=$request->works;
        $analysisTool=$this->getAnalysisTool();
        $getDbObject=$this->getGetDbObject();
        $vacancies=$getDbObject->getVacancyDbObject(['id','vacancy_name','claim_experience','company_id','link'],$works);
        $claimExperienceCount=[];
        foreach($vacancies as $vacancy){
            $analysisTool->handleVacancySumCol($claimExperienceCount,$vacancy->claim_experience,$vacancy,['vacancyCol'=>'vacancy','companyCol'=>'company']);
        }
        $analysisTool->hashContentToPercent($claimExperienceCount,$works);
        return $claimExperienceCount;
    }
    
     /**
     * @OA\GET(
     *     path="/api/toolCount",
     *     tags={"職缺資訊"},
     *     summary="取得工具統計分析資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getToolCount(Request $request){
        $works=$request->works;
        $analysisTool=$this->getAnalysisTool();
        $getDbObject=$this->getGetDbObject();
        $vacancies=$getDbObject->getVacancyDbObject(['id','vacancy_name','company_id','link'],$works);
        $toolCount=[];
        foreach($vacancies as $vacancy){
            $tool=$vacancy->tool->toarray();
            foreach($tool as $toolItem){
                $analysisTool->handleVacancySumCol($toolCount,$toolItem['vacancy_tool'],$vacancy,['vacancyCol'=>'vacancy','companyCol'=>'company']);
            }
        }
        $analysisTool->hashContentToPercent($toolCount,$works);
        return $toolCount;
    }

}
