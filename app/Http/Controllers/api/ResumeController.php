<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function getResumeTool(Request $request){
        $user_id=$request->id;
        $resume = Resume::select('user_id')->find($user_id);
        $resumeTools=$resume->tool->toarray();
        return $resumeTools;
        $resumeTools=array_column($resumeTools,'vacancy_tool');
    }
}
