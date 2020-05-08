<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Tool\MathTool;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tool\UseApi;
use App\Vacancy;
use App\Http\Controllers\Tool\CalScore;
use Redirect;

class WorkAnalysisController extends Controller
{
    private function getCalScore(){
        $calScore=new CalScore;
        return $calScore;
    }
    public function index(Request $request){ 
        $calScore=$this->getCalScore();
        function getCompanyInfo($Vacancies)
        {
            $Companies=[];
            foreach($Vacancies as $Vacancy){
                $Companies[$Vacancy->id]=$Vacancy->company;
            }
            return $Companies;
        }
        
        function isSetCategory($request)
        {
            return $request->vacancy_category;
        }
        // 判斷職缺分類
        if(isSetCategory($request)){
            $Vacancies=Vacancy::all('id','vacancy_name','company_id','claim_experience','claim_education','vacancy_category','link')->where('vacancy_category',$request->vacancy_category);
        }else{
            $Vacancies=Vacancy::all('id','vacancy_name','claim_experience','claim_education','company_id','link');
        }
        $tools=[];
        $categories=[];
        foreach($Vacancies as $key=>$vacancy){
            foreach($vacancy->tool->toarray() as $vacancyTool){
                $tools[$vacancy->id][]=$vacancyTool['vacancy_tool'];
            }
            foreach($vacancy->category->toarray() as $vacancyCategory){
                $categories[$vacancy->id][]=$vacancyCategory['vacancy_category'];
            }
        }
        $Companies=getCompanyInfo($Vacancies);
        $Vacancies=$Vacancies->toarray();
        $score=$calScore->calScore($Vacancies,$tools,$categories);
        //dd($Vacancies);
        // 取得職缺對應的公司名稱
        return view('user.savework.index',compact('Vacancies','Companies','score'));
    }
    public function form(Request $request)
    {
        function getCompanyInfo($search)
        {
            $useApi = new UseApi(); 
            $Companies = $useApi->CallApi('GET','api/getCompanies',$search);
            return $Companies;
        }
        function getVacancyInfo($search)
        {
            $useApi = new UseApi();
            $Vacancies = $useApi->CallApi('GET','api/getVacancies',$search);
            $Categories = $useApi->CallApi('GET','api/getCategories',$search);
            $Tools = $useApi->CallApi('GET','api/getTools',$search);
            return [$Vacancies,$Categories,$Tools];
        }
        function isSetSessionWork($request)
        {
            return $request->session()->has('works');
        }
        function isPost($request)
        {
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
        $search = ['works'=>$works];
        // 取得職缺資訊
        list($Vacancies,$Categories,$Tools)=getVacancyInfo($search);
        // 取得公司資訊
        $Companies = getCompanyInfo($search);
        // 計算職缺與使用者合適程度 & 取得使用者履歷資訊
        // 職缺與履歷進行比對 
        // 比對項目:[tool,category]
        //list($resume,$resumeTools,$resumeCategories,$sortVacancy) = calculateSuitableScore($Vacancies,$Categories,$Tools);
        //compact裡的項目->'sortVacancy'
        return view('user.savework.analysis.show',compact('Vacancies','Categories','Tools','Companies','resume','resumeTools','resumeCategories'));
    }
    
    public function detail(Request $request)
    {
        function getResumeInfo()
        {
            $useApi = new UseApi();
            $search=['id'=>Auth::id()];
            $resumes = $useApi->CallApi('GET','api/Resume',$search);
            $resumeTools = $useApi->CallApi('GET','api/ResumeTool',$search);
            $resumeCategories = $useApi->CallApi('GET','api/ResumeCategory',$search);
            return array($resumes,$resumeTools,$resumeCategories);
        }
        function getAnalysisCompany($search)
        {
            $useApi = new UseApi(); 
            $industryCategories = $useApi->CallApi('GET','api/industryCategoryCount',$search);
            $capitals = $useApi->CallApi('GET','api/capital',$search);
            $workers = $useApi->CallApi('GET','api/workers',$search);
            return array($industryCategories,$capitals,$workers);
        }
        function getAnalysisVacancy($search)
        {
            $useApi = new UseApi();
            $claimExperiences = $useApi->CallApi('GET','api/claimExperienceCount',$search);
            $claimEducations = $useApi->CallApi('GET','api/claimEducationCount',$search);
            $categories = $useApi->CallApi('GET','api/categoryCount',$search);
            $tools = $useApi->CallApi('GET','api/toolCount',$search);
            return array($claimExperiences,$claimEducations,$categories,$tools);
        }
        function isSetSessionWork($request)
        {
            return $request->session()->has('works');
        }

        // 教育與經歷清單
        $Educations = ['不拘','高中','專科','大學','碩士','博士'];
        $Experiences = ['不拘','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年'];
        // 取得資料
        if(isSetSessionWork($request)){
            $works=session('works');
        }else{
            return Redirect::to('/user/saveWork/');
        }
        // 設定Api參數
        $search = ['works'=>$works];
        // 取得職缺分析資訊
        list($claimExperiences,$claimEducations,$categories,$tools) = getAnalysisVacancy($search);
        // 取得公司分析資訊
        list($industryCategories,$capitals,$workers) = getAnalysisCompany($search);
        // 取得使用者履歷資訊
        list($resumes,$resumeTools,$resumeCategories) = getResumeInfo();

        return view('user.savework.analysis.detail',compact('claimExperiences','claimEducations','tools','categories','industryCategories','capitals','workers','resumes','resumeTools','resumeCategories','Educations','Experiences'));
    }
    public function suitable(Request $request)
    {
        return view('user.savework.analysis.suitable');
    }
}
