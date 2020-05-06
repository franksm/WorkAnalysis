<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Company;
use App\Vacancy;
use App\VacancyCategory;
use Redirect;
use App\Resume;
class WorkAnalysisController extends Controller
{
    public function index(Request $request){
        function getCompanyInfo($Vacancies){
            $Companies=[];
            foreach($Vacancies as $Vacancy){
                $Companies[$Vacancy->id]=$Vacancy->company;
            }
            return $Companies;
        }
        function isSetCategory($request){
            return $request->vacancy_category;
        }

        // 判斷職缺分類
        if(isSetCategory($request)){
            $Vacancies=Vacancy::all('id','vacancy_name','company_id','vacancy_category','link')->where('vacancy_category',$request->vacancy_category);
        }else{
            $Vacancies=Vacancy::all('id','vacancy_name','company_id','link');
        }
        // 取得職缺對應的公司名稱
        $Companies=getCompanyInfo($Vacancies);
        
        return view('user.savework.index',compact('Vacancies','Companies'));
    }
    public function form(Request $request)
    {
        function calculateSuitableScore($Vacancies,$Categories,$Tools){
            function getResumeInfo(){
                $user_id=Auth::id();
                $resumeToolsUrl = "http://laravel.test/api/ResumeTool?id=".$user_id;
                $resumeTools = json_decode(file_get_contents($resumeToolsUrl),true);
                $resumeCategoryUrl = "http://laravel.test/api/ResumeCategory?id=".$user_id;
                $resumeCategories = json_decode(file_get_contents($resumeCategoryUrl),true);
                return array($resumeTools,$resumeCategories);
            }

            list($resumeTools,$resumeCategories)=getResumeInfo();
            foreach($Vacancies as $key=>$Vacancy){
                $score=0;
                $id = $Vacancy->id;
                $vacancyTool=array_column($Tools[$id],'vacancy_tool');
                $score+=count(array_intersect($vacancyTool,$resumeTools));
                $vacancyCategory=array_column($Categories[$id],'vacancy_category');
                $score+=count(array_intersect($vacancyCategory,$resumeCategories));
                $Vacancies[$key]->score=$score;
            }
        }
        function getCompanyInfo($search){
            $CompanyUrl = "http://laravel.test/api/get_companies?".$search;
            $Companies = json_decode(file_get_contents($CompanyUrl),true);
            return $Companies;
        }
        function getVacancyInfo($search){
            $VacancyUrl = "http://laravel.test/api/getVacancies?".$search;
            $Vacancies = json_decode(file_get_contents($VacancyUrl));
            $CategoryUrl = "http://laravel.test/api/getCategories?".$search;
            $Categories = json_decode(file_get_contents($CategoryUrl),true);
            $ToolUrl = "http://laravel.test/api/getTools?".$search;
            $Tools = json_decode(file_get_contents($ToolUrl),true);
            return array($Vacancies,$Categories,$Tools);
        }
        function setApiParameter($works){
            $search = "";
            foreach($works as $work){
                $search .= "works[]=".$work."&";
            }
            return $search;
        }
        function isSetSessionWork($request){
            return $request->session()->has('works');
        }
        function isPost($request){
            return $request->isMethod('post');
        }
        
        // 取得資料
        if(isPost($request)){
            $works=$request->works;
            session(['works' =>$works]);
        }
        else if(isSetSessionWork($request)){
            $works=session('works');
        }else{
            return Redirect::to('/user/saveWork/');
        }
        // 設定Api參數
        $search = setApiParameter($works);
        // 取得職缺資訊
        list($Vacancies,$Categories,$Tools)=getVacancyInfo($search);
        // 取得公司資訊
        $Companies = getCompanyInfo($search);
        // 計算職缺與使用者合適程度
        // 職缺與履歷進行比對 
        // 比對項目:[tool,category]
        calculateSuitableScore($Vacancies,$Categories,$Tools);
        
        return view('user.savework.analysis.show',compact('Vacancies','Categories','Tools','Companies'));
    }
    
    public function detail(Request $request)
    {
        function getResumeInfo(){

            $user_id=Auth::id();
            $resumeUrl = "http://laravel.test/api/Resume?id=".$user_id;
            $resumes = json_decode(file_get_contents($resumeUrl),true);
            $resumeToolsUrl = "http://laravel.test/api/ResumeTool?id=".$user_id;
            $resumeTools = json_decode(file_get_contents($resumeToolsUrl),true);
            $resumeCategoryUrl = "http://laravel.test/api/ResumeCategory?id=".$user_id;
            $resumeCategories = json_decode(file_get_contents($resumeCategoryUrl),true);
            return array($resumes,$resumeTools,$resumeCategories);
        }
        function getAnalysisCompany($search){
            $industryCategoryUrl = "http://laravel.test/api/industryCategoryCount?".$search;
            $industryCategories = json_decode(file_get_contents($industryCategoryUrl),true);
            $capitalUrl = "http://laravel.test/api/capital?".$search;
            $capitals = json_decode(file_get_contents($capitalUrl),true);
            $workerUrl = "http://laravel.test/api/workers?".$search;
            $workers = json_decode(file_get_contents($workerUrl),true);
            return array($industryCategories,$capitals,$workers);
        }
        function getAnalysisVacancy($search){
            $claimExperienceUrl = "http://laravel.test/api/claimExperienceCount?".$search;
            $claimExperiences = json_decode(file_get_contents($claimExperienceUrl),true);
            $claimEducationUrl = "http://laravel.test/api/claimEducationCount?".$search;
            $claimEducations = json_decode(file_get_contents($claimEducationUrl),true);
            $categoryUrl = "http://laravel.test/api/categoryCount?".$search;
            $categories = json_decode(file_get_contents($categoryUrl),true);
            $toolUrl = "http://laravel.test/api/toolCount?".$search;
            $tools = json_decode(file_get_contents($toolUrl),true);
            return array($claimExperiences,$claimEducations,$categories,$tools);
        }
        function setApiParameter($works){
            $search = "";
            foreach($works as $work){
                $search .= "works[]=".$work."&";
            }
            return $search;
        }
        function isSetSessionWork($request){
            return $request->session()->has('works');
        }

        // 教育與經歷清單
        $Eductions = ['不拘','高中','專科','大學','碩士','博士'];
        $Experiences = ['不拘','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年'];
        // 取得資料
        if(isSetSessionWork($request)){
            $works=session('works');
        }else{
            return Redirect::to('/user/saveWork/');
        }
        // 設定Api參數
        $search = setApiParameter($works);
        // 取得職缺分析資訊
        list($claimExperiences,$claimEducations,$categories,$tools) = getAnalysisVacancy($search);
        // 取得公司分析資訊
        list($industryCategories,$capitals,$workers) = getAnalysisCompany($search);
        // 取得使用者履歷資訊
        list($resumes,$resumeTools,$resumeCategories) = getResumeInfo();

        return view('user.savework.analysis.detail',compact('claimExperiences','claimEducations','tools','categories','industryCategories','capitals','workers','resumes','resumeTools','resumeCategories','Eductions','Experiences'));
    }
}
