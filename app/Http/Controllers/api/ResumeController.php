<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Resume;
class ResumeController extends Controller
{
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
        $resume = Resume::select('id','user_id','experience','eduction')->find($user_id)->toarray();
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
        $resume = Resume::select('id','user_id')->find($user_id);
        $resumeTools=$resume->tool->toarray();
        $resumeTools=array_column($resumeTools,'vacancy_tool');
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
        $resume = Resume::select('id','user_id')->find($user_id);
        $resumeCategories=$resume->category->toarray();
        $resumeCategories=array_column($resumeCategories,'vacancy_category');
        return $resumeCategories;
    }
}
