<?php

namespace App\Http\Controllers\backend\vacancy;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Resume;
use App\Company;
use App\Vacancy;
use App\VacancyCategory;
use Redirect;

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
        $urlApi = "http://laravel.test/api/get_vacancies?".$search;
        $Vacancies = json_decode(file_get_contents($urlApi));
        $urlApi = "http://laravel.test/api/get_categories?".$search;
        $Categories = json_decode(file_get_contents($urlApi),true);
        $urlApi = "http://laravel.test/api/get_tools?".$search;
        $Tools = json_decode(file_get_contents($urlApi),true);
        $urlApi = "http://laravel.test/api/get_companies?".$search;
        $Companies = json_decode(file_get_contents($urlApi),true);
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
        $resume = Resume::where(['user_id' => Auth::id()])->first();
        $resumeTools=$resume->tool->toarray();
        $resumeTools=array_column($resumeTools,'vacancy_tool');

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
        
        $sameTools = array_intersect(array_keys($tools),$resumeTools);
        return view('frontend.detail',compact('claimExperiences','claimEducations','tools','categories','industryCategories','sameTools'));
    }
}
