<?php

namespace App\Http\Controllers\api;

use App\Company;
use App\Vacancy;
use App\VacancyCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="My First API", version="0.1")
 */

class WorkController extends Controller
{
    public function getVacancyId()
    {
        $vacancyId=Vacancy::all('id');
        return $vacancyId;
    }
    /**
     * @OA\GET(
     *     path="/api/get_vacancies",
     *     tags={"職缺資訊"},
     *     summary="取得職缺資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function get_vacancies(Request $request)
    {
        $works=$request->works;
        $Vacancies=Vacancy::all()->find($works);
        return $Vacancies;
    }
    /**
     * @OA\GET(
     *     path="/api/get_categories",
     *     tags={"職缺資訊"},
     *     summary="取得職缺種類資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function get_categories(Request $request)
    {
        $works=$request->works;
        $Vacancies=Vacancy::all()->find($works);
        $Categories=[];
        foreach($Vacancies as $Vacancy){
            $Categories[$Vacancy->id]=$Vacancy->category->toarray();
        }
        return $Categories;
    }
    /**
     * @OA\GET(
     *     path="/api/get_tools",
     *     tags={"職缺資訊"},
     *     summary="取得職缺需求工具資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function get_tools(Request $request)
    {
        $works=$request->works;
        $Vacancies=Vacancy::all()->find($works);
        $Tools=[];
        foreach($Vacancies as $Vacancy){
            $Tools[$Vacancy->id]=$Vacancy->tool->toarray();
        }
        return $Tools;
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
        $Vacancies=Vacancy::all()->find($works);
        $CategoryCount=[];
        foreach($Vacancies as $Vacancy){
            $Category=$Vacancy->category->toarray();
            $Company=$Vacancy->company;
            foreach($Category as $categoryItem){
                if (isset($CategoryCount[$categoryItem['vacancy_category']]['percentage'])){
                    $CategoryCount[$categoryItem['vacancy_category']]['percentage']++;
                }
                else{
                    $CategoryCount[$categoryItem['vacancy_category']]['percentage']=1;
                }
                $CategoryCount[$categoryItem['vacancy_category']]['vacancy'][$Vacancy->id]['vacancy_name']=$Vacancy->vacancy_name;
                $CategoryCount[$categoryItem['vacancy_category']]['vacancy'][$Vacancy->id]['vacancy_link']=$Vacancy->link;
                $CategoryCount[$categoryItem['vacancy_category']]['vacancy'][$Vacancy->id]['company_name']=$Company->company_name;
                $CategoryCount[$categoryItem['vacancy_category']]['vacancy'][$Vacancy->id]['company_link']=$Company->link;
            }
        }
        foreach($CategoryCount as $Category => $Count){
            $CategoryCount[$Category]['percentage']=round($Count['percentage']/count($works)*100,1);
        }
        return $CategoryCount;
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
        $Vacancies=Vacancy::all()->find($works);
        $ClaimEducationCount=[];
        foreach($Vacancies as $Vacancy){
                $Company=$Vacancy->company;
                if (isset($ClaimEducationCount[$Vacancy->claim_education]['percentage'])){
                    $ClaimEducationCount[$Vacancy->claim_education]['percentage']++;
                }
                else{
                    $ClaimEducationCount[$Vacancy->claim_education]['percentage']=1;
                }
                $ClaimEducationCount[$Vacancy->claim_education]['vacancy'][$Vacancy->id]['vacancy_name']=$Vacancy->vacancy_name;
                $ClaimEducationCount[$Vacancy->claim_education]['vacancy'][$Vacancy->id]['vacancy_link']=$Vacancy->link;
                $ClaimEducationCount[$Vacancy->claim_education]['vacancy'][$Vacancy->id]['company_name']=$Company->company_name;
                $ClaimEducationCount[$Vacancy->claim_education]['vacancy'][$Vacancy->id]['company_link']=$Company->link;
        }
        foreach($ClaimEducationCount as $Education => $Count){
            $ClaimEducationCount[$Education]['percentage']=round($Count['percentage']/count($works)*100,1); 
        }
        return $ClaimEducationCount;
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
        $Vacancies=Vacancy::all()->find($works);
        $ClaimExperienceCount=[];
        foreach($Vacancies as $Vacancy){
                $Company=$Vacancy->company;
                if (isset($ClaimExperienceCount[$Vacancy->claim_experience]['percentage'])){
                    $ClaimExperienceCount[$Vacancy->claim_experience]['percentage']++;
                }
                else{
                    $ClaimExperienceCount[$Vacancy->claim_experience]['percentage']=1;
                }
                $ClaimExperienceCount[$Vacancy->claim_experience]['vacancy'][$Vacancy->id]['vacancy_name']=$Vacancy->vacancy_name;
                $ClaimExperienceCount[$Vacancy->claim_experience]['vacancy'][$Vacancy->id]['vacancy_link']=$Vacancy->link;
                $ClaimExperienceCount[$Vacancy->claim_experience]['vacancy'][$Vacancy->id]['company_name']=$Company->company_name;
                $ClaimExperienceCount[$Vacancy->claim_experience]['vacancy'][$Vacancy->id]['company_link']=$Company->link;
        }
        foreach($ClaimExperienceCount as $Experience => $Count){
            $ClaimExperienceCount[$Experience]['percentage']=round($Count['percentage']/count($works)*100,1); 
        }
        return $ClaimExperienceCount;
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
        $Vacancies=Vacancy::all()->find($works);
        $ToolCount=[];
        foreach($Vacancies as $Vacancy){
            $Tool=$Vacancy->tool->toarray();
            $Company=$Vacancy->company;
            foreach($Tool as $ToolItem){
                if (isset($ToolCount[$ToolItem['vacancy_tool']]['percentage'])){
                    $ToolCount[$ToolItem['vacancy_tool']]['percentage']++;
                }
                else{
                    $ToolCount[$ToolItem['vacancy_tool']]['percentage']=1;
                }
                $ToolCount[$ToolItem['vacancy_tool']]['vacancy'][$Vacancy->id]['vacancy_name']=$Vacancy->vacancy_name;
                $ToolCount[$ToolItem['vacancy_tool']]['vacancy'][$Vacancy->id]['vacancy_link']=$Vacancy->link;
                $ToolCount[$ToolItem['vacancy_tool']]['vacancy'][$Vacancy->id]['company_name']=$Company->company_name;
                $ToolCount[$ToolItem['vacancy_tool']]['vacancy'][$Vacancy->id]['company_link']=$Company->link;
            }
        }
        foreach($ToolCount as $Tool => $Count){
            $ToolCount[$Tool]['percentage']=round($Count['percentage']/count($works)*100,1);
        }
        return $ToolCount;
    }

}
