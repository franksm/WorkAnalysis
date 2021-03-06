<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Tool\GetDbObject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Resume;

class ResumeController extends Controller
{

    public function checkResume($request){
        $getDbObject=new GetDbObject;
        $resume = $getDbObject->getResumeDbObject(['id','user_id'],$request);
        return $resume;
    }

    /**
     * @OA\GET(
     *     path="/api/Resume",
     *     tags={"履歷資訊"},
     *     summary="取得履歷資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="id", in="query",@OA\Schema(type="integer"), required=true, description="請輸入使用者id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getResume(Request $request){
        $user_id=$request->id;
        $getDbObject=new GetDbObject;
        $resume = $getDbObject->getResumeDbObject(['id','user_id','experience','education'],$user_id);
        return $resume;
    }
    /**
     * @OA\GET(
     *     path="/api/ResumeTool",
     *     tags={"履歷資訊"},
     *     summary="取得擅長工具資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="id", in="query",@OA\Schema(type="integer"), required=true, description="請輸入使用者id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getResumeTool(Request $request){
        $user_id=$request->id;
        $getDbObject=new GetDbObject;
        $resume = $getDbObject->getResumeDbObject(['id','user_id'],$user_id);
        $resumeTools=$resume->tool->toarray();
        return $resumeTools;
    }
    /**
     * @OA\GET(
     *     path="/api/ResumeCategory",
     *     tags={"履歷資訊"},
     *     summary="取得希望職缺種類",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="id", in="query",@OA\Schema(type="integer"), required=true, description="請輸入使用者id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getResumeCategory(Request $request){
        $user_id=$request->id;
        $getDbObject=new GetDbObject;
        $resume = $getDbObject->getResumeDbObject(['id','user_id'],$user_id);
        $resumeCategories=$resume->category->toarray();
        return $resumeCategories;
    }
}
