<?php

namespace App\Http\Controllers\api;

use App\Company;
use App\Vacancy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function GetCompanyInfo($works)
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
        $Companies=$this->getCompanyInfo($works);
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
        $Companies=$this->getCompanyInfo($works);
        $industryCategories=[];
        foreach($Companies as $Company){
            if (isset($industryCategories[$Company['industry_category']]['percentage'])){
                $industryCategories[$Company['industry_category']]['percentage']++;
            }
            else{
                $industryCategories[$Company['industry_category']]['percentage']=1;
            }
            $industryCategories[$Company['industry_category']]['company'][$Company->id]['company_name']=$Company->company_name;
            $industryCategories[$Company['industry_category']]['company'][$Company->id]['company_link']=$Company->link;
        }
        foreach($industryCategories as $Category => $Count){
            $industryCategories[$Category]['percentage']=round($Count['percentage']/count($works)*100,1); 
        }
        return $industryCategories;
    }
    /**
     * @OA\GET(
     *     path="/api/capital",
     *     tags={"公司資訊"},
     *     summary="取得資本額",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getCapital(Request $request)
    {
        $works=$request->works;
        $Companies=$this->getCompanyInfo($works);
        $capital=[];
        foreach($Companies as $Company){
            if($Company->capital=="暫不提供"){
                $capital[$Company->company_name]=0;
            }
            else{
                $capital[$Company->company_name]=(int)$Company->capital;
            }
        }
        return $capital;
    }
    /**
     * @OA\GET(
     *     path="/api/workers",
     *     tags={"公司資訊"},
     *     summary="取得員工人數",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getWorkers(Request $request)
    {
        $works=$request->works;
        $Companies=$this->useCompanyIdGetCompanyInfo($works);
        $workers=[];
        foreach($Companies as $Company){
            if($Company->workers=="暫不提供"){
                $workers[$Company->company_name]=0;
            }
            else{
                $workers[$Company->company_name]=$Company->workers;
            }
        }
        return $workers;
    }

}
