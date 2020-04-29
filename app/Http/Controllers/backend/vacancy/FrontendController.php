<?php

namespace App\Http\Controllers\backend\vacancy;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Vacancy;
use App\VacancyCategory;

class FrontendController extends Controller
{
    public function index(Request $request){
        if(isset($request->vacancy_category)){
            $Vacancies= Vacancy::all()->where('vacancy_category',$request->vacancy_category);
        }else{
            $Vacancies= Vacancy::all();
        }
        $Companies=[];
        foreach($Vacancies as $Vacancy){
            $Companies[$Vacancy->id]=$Vacancy->company;
        }
        $VacancyCategoties=VacancyCategory::all();
        return view('frontend.index')->with('Vacancies',$Vacancies)->with('Companies',$Companies)->with('VacancyCategoties',$VacancyCategoties);
    }
    public function form(Request $request){
        if(isset($request->works) and $request->isMethod('post')){
            $works=$request->works;
            session(['works' =>$works]);
        }
        else{
            $works=session('works');
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
        $works=session('works');   
        $search = "";
        foreach($works as $work){
            $search .= "works[]=".$work."&";
        }
        $claimExperienceUrl = "http://laravel.test/api/claimExperienceCount?".$search;
        $claimExperiences = json_decode(file_get_contents($claimExperienceUrl),true);
        $claimEducationUrl = "http://laravel.test/api/claimEducationCount?".$search;
        $claimEducations = json_decode(file_get_contents($claimEducationUrl),true);
        $categoryUrl = "http://laravel.test/api/categoryCount?".$search;
        $categories = json_decode(file_get_contents($categoryUrl),true);
        $toolUrl = "http://laravel.test/api/toolCount?".$search;
        $tools = json_decode(file_get_contents($toolUrl),true);
        return view('frontend.detail',compact('claimExperiences','claimEducations','tools','categories'));
    }
}
