<?php

namespace App\Http\Controllers\api;

use App\VacancyCategory;
use App\VacancyTool;
use App\Http\Controllers\Tool\setWeight;
use App\Vacancy;
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
     *     path="/api/getVacancies",
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
    public function getVacancies(Request $request)
    {
        $works=$request->works;
        $getDbObject=$this->getGeneralTool();
        $vacancies=$getDbObject->getVacancyDbObject([],$works,true);
        return $vacancies;
    }
    /**
     * @OA\GET(
     *     path="/api/getCategories",
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
     *     path="/api/getTools",
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
    
    public function saveWeight()
    {
        $setWeight=new setWeight;
        $vacancyCategories=VacancyCategory::all();
        $vacancyTools=VacancyTool::all();
        $Vacancies=Vacancy::all('id','claim_education','claim_experience');
        foreach($Vacancies as $Vacancy){
            $Vacancy->category;
            $Vacancy->tool;
        }
        $vacanciesWeight=$Vacancies->toarray();
        $weight=$setWeight->setVacancItemWeight($vacanciesWeight);
        foreach($Vacancies as $vacancy){
            $vacancy->weight_experience=$weight['experience'][$vacancy->claim_experience];
            $vacancy->weight_education=$weight['education'][$vacancy->claim_education];
            $vacancy->save();
        }
        foreach($vacancyCategories as $vacancyCategory){
            $vacancyCategory->weight=$weight['category'][$vacancyCategory->vacancy_category];
            $vacancyCategory->save();
        }
        foreach($vacancyTools as $vacancyTool){
            $vacancyTool->weight=$weight['tool'][$vacancyTool->vacancy_tool];
            $vacancyTool->save();
        }
    }
}