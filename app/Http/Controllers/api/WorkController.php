<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Tool\GetDbObject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="My First API", version="0.1")
 */

class WorkController extends Controller
{
    private function getGeneralTool(){
        $getDbObject=new GetDbObject;
        return $getDbObject;
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
    public function getVacancy(Request $request)
    {
        $works=$request->works;
        $getDbObject=$this->getGeneralTool();
        $vacancies=$getDbObject->getVacancyDbObject([],$works,true);
        return $vacancies;
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
    
    public function getCategories(Request $request)
    {
        $works=$request->works;
        $getDbObject=$this->getGeneralTool();
        $vacancies=$getDbObject->getVacancyDbObject(['id'],$works);
        $categories=[];
        foreach($vacancies as $vacancy){
            $categories[$vacancy->id]=$vacancy->category->toarray();
        }
        return $categories;
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
    public function getTools(Request $request)
    {
        $works=$request->works;
        $getDbObject=$this->getGeneralTool();
        $vacancies=$getDbObject->getVacancyDbObject(['id'],$works);
        $tools=[];
        foreach($vacancies as $vacancy){
            $tools[$vacancy->id]=$vacancy->tool->toarray();
        }
        return $tools;
    }

}