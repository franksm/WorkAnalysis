<?php

namespace App\Http\Controllers\backend\vacancy;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Company;
use App\Vacancy;
use App\VacancyCategory;
use Redirect;
use App\Resume;
class FrontendController extends Controller
{
    public function index(Request $request){
        if(isset($request->vacancy_category)){
            $Vacancies= Vacancy::all('id','vacancy_name','company_id','vacancy_category','link')->where('vacancy_category',$request->vacancy_category);
        }else{
            $Vacancies= Vacancy::all('id','vacancy_name','company_id','link');
        }
        $Companies=[];
        foreach($Vacancies as $Vacancy){
            $Companies[$Vacancy->id]=$Vacancy->company;
        }
        return view('frontend.index',compact('Vacancies','Companies'));
    }
    public function form(Request $request){
        if(isset($request->works) and $request->isMethod('post')){
            $works=$request->works;
            session(['works' =>$works]);
        }
        else if($request->session()->has('works')){
            $works=session('works');
        }else{
            return Redirect::to('/user/web/');
        }
        $search = "";
        foreach($works as $work){
            $search .= "works[]=".$work."&";
        }
        $urlApi = "http://laravel.test/api/getVacancies?".$search;
        $Vacancies = json_decode(file_get_contents($urlApi));
        $urlApi = "http://laravel.test/api/getCategories?".$search;
        $Categories = json_decode(file_get_contents($urlApi),true);
        $urlApi = "http://laravel.test/api/getTools?".$search;
        $Tools = json_decode(file_get_contents($urlApi),true);
        $urlApi = "http://laravel.test/api/get_companies?".$search;
        $Companies = json_decode(file_get_contents($urlApi),true);
        
        $user_id=Auth::id();
        $resumeToolsUrl = "http://laravel.test/api/ResumeTool?id=".$user_id;
        $resumeTools = json_decode(file_get_contents($resumeToolsUrl),true);
        $resumeCategoryUrl = "http://laravel.test/api/ResumeCategory?id=".$user_id;
        $resumeCategories = json_decode(file_get_contents($resumeCategoryUrl),true);

        foreach($Vacancies as $key=>$Vacancy){
            $score=0;
            $id = $Vacancy->id;
            $vacancyTool=array_column($Tools[$id],'vacancy_tool');
            $score+=count(array_intersect($vacancyTool,$resumeTools));
            $vacancyCategory=array_column($Categories[$id],'vacancy_category');
            $score+=count(array_intersect($vacancyCategory,$resumeCategories));
            $Vacancies[$key]->score=$score;
        }
        return view('frontend.show',compact('Vacancies','Categories','Tools','Companies'));
    }
    public function detail(Request $request)
    {
        if($request->session()->has('works')){
            $works=session('works');
        }else{
            return Redirect::to('/user/web/');
        }
        $works=session('works');   
        $search = "";
        foreach($works as $work){
            $search .= "works[]=".$work."&";
        }
        $user_id=Auth::id();
        $claimExperienceUrl = "http://laravel.test/api/claimExperienceCount?".$search;
        $claimExperiences = json_decode(file_get_contents($claimExperienceUrl),true);
        $claimEducationUrl = "http://laravel.test/api/claimEducationCount?".$search;
        $claimEducations = json_decode(file_get_contents($claimEducationUrl),true);
        $categoryUrl = "http://laravel.test/api/categoryCount?".$search;
        $categories = json_decode(file_get_contents($categoryUrl),true);
        $toolUrl = "http://laravel.test/api/toolCount?".$search;
        $tools = json_decode(file_get_contents($toolUrl),true);
        $industryCategoryUrl = "http://laravel.test/api/industryCategoryCount?".$search;
        $industryCategories = json_decode(file_get_contents($industryCategoryUrl),true);
        $capitalUrl = "http://laravel.test/api/capital?".$search;
        $capitals = json_decode(file_get_contents($capitalUrl),true);
        $workerUrl = "http://laravel.test/api/workers?".$search;
        $workers = json_decode(file_get_contents($workerUrl),true);
        $resumeUrl = "http://laravel.test/api/Resume?id=".$user_id;
        $resumes = json_decode(file_get_contents($resumeUrl),true);
        $resumeToolsUrl = "http://laravel.test/api/ResumeTool?id=".$user_id;
        $resumeTools = json_decode(file_get_contents($resumeToolsUrl),true);
        $resumeCategoryUrl = "http://laravel.test/api/ResumeCategory?id=".$user_id;
        $resumeCategories = json_decode(file_get_contents($resumeCategoryUrl),true);
        $Eductions = ['不拘','高中','專科','大學','碩士','博士'];
        $Experiences = ['不拘','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年'];
        return view('frontend.detail',compact('claimExperiences','claimEducations','tools','categories','industryCategories','capitals','workers','resumes','resumeTools','resumeCategories','Eductions','Experiences'));
    }
}
