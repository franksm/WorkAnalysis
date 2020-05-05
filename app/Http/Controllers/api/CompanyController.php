<?php

namespace App\Http\Controllers\api;

use App\Company;
use App\Vacancy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function useCompanyIdGetCompanyInfo($works)
    {
        $Vacancies=Vacancy::select('id','company_id')->find($works);
        $vacancyArray=[];
        foreach($Vacancies as $Vacancy){
            $vacancyArray[$Vacancy->company_id]=$Vacancy->company_id;
        }
        $Companies=Company::all()->find($vacancyArray);
        return $Companies;
    }
    /**
     * @OA\GET(
     *     path="/api/get_companies",
     *     tags={"公司資訊"},
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
        $Companies=$this->useCompanyIdGetCompanyInfo($works);
        foreach($Companies as $Company){
            $Company->vacancy;
        };
        return $Companies;
    }
    /**
     * @OA\GET(
     *     path="/api/industryCategoryCount",
     *     tags={"公司資訊"},
     *     summary="取得產業類別資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getIndustryCategoryCount(Request $request)
    {
        $works=$request->works;
        $Companies=$this->useCompanyIdGetCompanyInfo($works);
        $industryCategories=[];
        foreach($Companies as $Company){
            if (isset($industryCategories[$Company['industry_category']])){
                $industryCategories[$Company['industry_category']]++;
            }
            else{
                $industryCategories[$Company['industry_category']]=1;
            }
        }
        foreach($industryCategories as $Category => $Count){
            $industryCategories[$Category]=round($Count/count($works)*100,1); 
        }
        return $industryCategories;
    }
    
}
