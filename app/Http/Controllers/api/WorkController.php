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
    /**
     * @OA\GET(
     *     path="/api/get_vacancies",
     *     tags={"給我職缺資訊"},
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
     *     tags={"給我職缺資訊"},
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
     *     tags={"給我職缺資訊"},
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
        $Vacancies=Vacancy::all()->find($works);
        $Categories=[];
        foreach($Vacancies as $Vacancy){
            $Categories[$Vacancy->id]=$Vacancy->category->toarray();
        }
        $CategoryCount=[];
        foreach($Categories as $Category){
            foreach($Category as $categoryItem){
                if (isset($CategoryCount[$categoryItem['vacancy_category']])){
                    $CategoryCount[$categoryItem['vacancy_category']]++;
                }
                else{
                    $CategoryCount[$categoryItem['vacancy_category']]=1;
                }
            }
        }
        foreach($CategoryCount as $Category => $Count){
            $CategoryCount[$Category]=round($Count/count($works)*100,1); 
        }
        return $CategoryCount;
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
        $Vacancies=Vacancy::all()->find($works);
        $vacanciesClaimEducation=[];
        foreach($Vacancies as $Vacancy){
            if (isset($vacanciesClaimEducation[$Vacancy->claim_education])){
                $vacanciesClaimEducation[$Vacancy->claim_education]++;
            }
            else{
                $vacanciesClaimEducation[$Vacancy->claim_education]=1;
            }
        }
        foreach($vacanciesClaimEducation as $Education => $Count){
            $vacanciesClaimEducation[$Education]=round($Count/count($works)*100,1); 
        }
        return $vacanciesClaimEducation;
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
        $Vacancies=Vacancy::all()->find($works);
        $vacanciesClaimExperience=[];
        foreach($Vacancies as $Vacancy){
            if (isset($vacanciesClaimExperience[$Vacancy->claim_experience])){
                $vacanciesClaimExperience[$Vacancy->claim_experience]++;
            }
            else{
                $vacanciesClaimExperience[$Vacancy->claim_experience]=1;
            }
        }
        foreach($vacanciesClaimExperience as $Experience => $Count){
            $vacanciesClaimExperience[$Experience]=round($Count/count($works)*100,1); 
        }
        return $vacanciesClaimExperience;
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
    public function getToolCount(Request $request){
        $works=$request->works;
        $Vacancies=Vacancy::all()->find($works);
        $Tools=[];
        foreach($Vacancies as $Vacancy){
            $Tools[$Vacancy->id]=$Vacancy->tool->toarray();
        }
        $ToolCount=[];
        foreach($Tools as $Tool){
            foreach($Tool as $toolItem){
                if (isset($ToolCount[$toolItem['vacancy_tool']])){
                    $ToolCount[$toolItem['vacancy_tool']]++;
                }
                else{
                    $ToolCount[$toolItem['vacancy_tool']]=1;
                }
            }
        }
        foreach($ToolCount as $Tool => $Count){
            $ToolCount[$Tool]=round($Count/count($works)*100,1); 
        }
        return $ToolCount;
    }
}
