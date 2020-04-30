<?php

namespace App\Http\Controllers\api;

use App\Company;
use App\Vacancy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @OA\GET(
     *     path="/api/get_companies",
     *     tags={"給我職缺資訊"},
     *     summary="取得公司資訊",
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
        // $Companies=[];
        // foreach($Vacancies as $Vacancy){
        //     $Companies[$Vacancy->id]=$Vacancy->company->toarray();
        // }

        return $Vacancies;
    }
}
