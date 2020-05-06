<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Tool\GetDbObject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private function getGeneralTool(){
        $getDbObject=new GetDbObject;
        return $getDbObject;
    }
    /**
     * @OA\GET(
     *     path="/api/getCompanies",
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
    public function getCompanies(Request $request)
    {
        $works=$request->works;
        $getDbObject=$this->getGeneralTool();
        $companies=$getDbObject->getCompanyDbObject($works);
        foreach($companies as $company){
            $company->vacancy;
        };
        return $companies;
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
        $getDbObject=$this->getGeneralTool();
        $companies=$getDbObject->getCompanyDbObject($works);
        $capital=[];
        foreach($companies as $company){
            if($company->capital=="暫不提供"){
                $capital[$company->company_name]=0;
            }
            else{
                $capital[$company->company_name]=(int)$company->capital;
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
        $getDbObject=$this->getGeneralTool();
        $companies=$getDbObject->getCompanyDbObject($works);
        $workers=[];
        foreach($companies as $company){
            if($company->workers=="暫不提供"){
                $workers[$company->company_name]=0;
            }
            else{
                $workers[$company->company_name]=(int)$company->workers;
            }
        }
        return $workers;
    }

}
