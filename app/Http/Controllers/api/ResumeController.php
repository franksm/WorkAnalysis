<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Resume;
class ResumeController extends Controller
{
    public function getResumeTool(Request $request){
        $user_id=$request->id;
        $resume = Resume::select('id','user_id')->find($user_id);
        $resumeTools=$resume->tool->toarray();
        $resumeTools=array_column($resumeTools,'vacancy_tool');
        return $resumeTools;
    }
    public function getResumeCategory(Request $request){
        $user_id=$request->id;
        $resume = Resume::select('id','user_id')->find($user_id);
        $resumeCategories=$resume->category->toarray();
        $resumeCategories=array_column($resumeCategories,'vacancy_category');
        return $resumeCategories;
    }
}
