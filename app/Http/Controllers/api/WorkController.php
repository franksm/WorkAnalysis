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
        $Vacancies=Vacancy::all()->find($works)->toarray();
        return $Vacancies;
    }
    /**
     * @OA\GET(
     *     path="/api/get_categories",
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
     *     summary="取得職缺資訊",
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
     *     path="/api/get_companies",
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
    public function get_companies(Request $request)
    {
        $works=$request->works;
        $Vacancies=Vacancy::all()->find($works);
        $Companies=[];
        foreach($Vacancies as $Vacancy){
            $Companies[$Vacancy->id]=$Vacancy->company->toarray();
        }
        return $Companies;
    }
}
