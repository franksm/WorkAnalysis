<?php

namespace App\Http\Controllers\api;

use App\Vacancy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\api\StatisticsMethod as StatisticMethod;

class StatisticsWorksController extends Controller
{
    private function getStatisticsMethod(){
        $statisticsMethod=new StatisticsMethod;
        return $statisticsMethod;
    }
    /**
     * @OA\GET(
     *     path="/api/categoryCount",
     *     tags={"給我職缺資訊"},
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
        $statisticsMethod=$this->getStatistics();
        $vacancies=$statisticsMethod->vacancySelectCol(['id','vacancy_name','company_id','link'],$works);
        $categoryCount=[];
        foreach($vacancies as $vacancy){
            $category=$vacancy->category->toarray();
            foreach($category as $categoryItem){
                $statisticsMethod->judgmentInHash($categoryCount,$categoryItem['vacancy_category']);
                $statisticsMethod->popFormInfo($categoryCount,$categoryItem['vacancy_category'],$vacancy);
            }
        }
        $statisticsMethod->hashContentPercent($categoryCount,$works);
        return $categoryCount;
    }

    /**
     * @OA\GET(
     *     path="/api/claimEducationCount",
     *     tags={"給我職缺資訊"},
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
        $vacancies=$this->vacancySelectCol(['id','vacancy_name','claim_education','company_id','link'],$works);
        $claimEducationCount=[];
        foreach($vacancies as $vacancy){
            $this->judgmentInHash($claimEducationCount,$vacancy->claim_education);
            $this->popFormInfo($claimEducationCount,$vacancy->claim_education,$vacancy);
        }
        $this->hashContentPercent($claimEducationCount,$works);
        return $claimEducationCount;
    }

    /**
     * @OA\GET(
     *     path="/api/claimExperienceCount",
     *     tags={"給我職缺資訊"},
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
        $statisticsMethod=$this->getStatisticsMethod();
        $vacancies=$statisticsMethod->vacancySelectCol(['id','vacancy_name','claim_experience','company_id','link'],$works);
        $claimExperienceCount=[];
        foreach($vacancies as $vacancy){
            $statisticsMethod->judgmentInHash($claimExperienceCount,$vacancy->claim_experience);
            $statisticsMethod->popFormInfo($claimExperienceCount,$vacancy->claim_experience,$vacancy);
        }
        $statisticsMethod->hashContentPercent($claimExperienceCount,$works);
        return $claimExperienceCount;
    }
    
     /**
     * @OA\GET(
     *     path="/api/toolCount",
     *     tags={"給我職缺資訊"},
     *     summary="取得工具統計分析資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function gettoolCount(Request $request){
        $works=$request->works;
        $vacancies=$this->vacancySelectCol(['id','vacancy_name','company_id','link'],$works);
        $toolCount=[];
        foreach($vacancies as $vacancy){
            $Tool=$vacancy->tool->toarray();
            foreach($Tool as $ToolItem){
                $this->judgmentInHash($toolCount,$ToolItem['vacancy_tool']);
                $this->popFormInfo($toolCount,$ToolItem['vacancy_tool'],$vacancy);
            }
        }
        $this->hashContentToPercent($toolCount,$works);
        return $toolCount;
    }

}
