<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Tool\AnalysisTool;
use App\Http\Controllers\Tool\GetDbObject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalysisCompanyController extends Controller
{
    private function getAnalysisTool(){
        $analysisTool=new AnalysisTool;
        return $analysisTool;
    }
    private function getGetDbObject(){
        $getDbObject=new GetDbObject;
        return $getDbObject;
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
        $getDbObject=$this->getGetDbObject();
        $analysisTool=$this->getAnalysisTool();
        $companies=$getDbObject->getCompanyDbObject($works);
        $industryCategories=[];
        foreach($companies as $company){
            $analysisTool->handleCompanySumCol($industryCategories,$company['industry_category'],$company,'company');
        }
        $analysisTool->hashContentToPercent($industryCategories,$companies);
        return $industryCategories;
    }
}
