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
        $countCategory=0;
        foreach($Vacancies as $Vacancy){
            $Categories[$Vacancy->id]=$Vacancy->category->toarray();
        }
        $CategoryCount=[];
        foreach($Categories as $Category){
            foreach($Category as $categoryItem){
                $countCategory++;
                if (isset($CategoryCount[$categoryItem['vacancy_category']])){
                    $CategoryCount[$categoryItem['vacancy_category']]++;
                }
                else{
                    $CategoryCount[$categoryItem['vacancy_category']]=1;
                }
            }
        }
        $CategoryCount['total']=$countCategory;
        return $CategoryCount;
    }
    /**
     * @OA\GET(
     *     path="/api/claimEducation",
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
        $countClaimEducation=0;
        foreach($Vacancies as $Vacancy){
            $countClaimEducation++;
            if (isset($vacanciesClaimEducation[$Vacancy->claim_education])){
                $vacanciesClaimEducation[$Vacancy->claim_education]++;
            }
            else{
                $vacanciesClaimEducation[$Vacancy->claim_education]=1;
            }
        }
        $vacanciesClaimEducation['total']=$countClaimEducation;
        return $vacanciesClaimEducation;
    }
    /**
     * @OA\GET(
     *     path="/api/claimExperience",
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
        $vacanciesClaimexperience=[];
        $countClaimExperience=0;
        foreach($Vacancies as $Vacancy){
            $countClaimExperience++;
            if (isset($vacanciesClaimexperience[$Vacancy->claim_experience])){
                $vacanciesClaimexperience[$Vacancy->claim_experience]++;
            }
            else{
                $vacanciesClaimexperience[$Vacancy->claim_experience]=1;
            }
        }
        $vacanciesClaimexperience['total']=$countClaimExperience;
        return $vacanciesClaimexperience;
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
        $countTool=0;
        $ToolCount=[];
        foreach($Tools as $Tool){
            foreach($Tool as $toolItem){
                $countTool++;
                if (isset($ToolCount[$toolItem['vacancy_tool']])){
                    $ToolCount[$toolItem['vacancy_tool']]++;
                }
                else{
                    $ToolCount[$toolItem['vacancy_tool']]=1;
                }
            }
        }
        $ToolCount['total']=$countTool;
        return $ToolCount;
    }
}
