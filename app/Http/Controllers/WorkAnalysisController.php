<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Statistics as Statistics;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tool\UseApi;
use App\Vacancy;
use Redirect;

class WorkAnalysisController extends Controller
{
    public function index(Request $request)
    {
        
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
        function calculateSuitableScore($Vacancies,$Categories,$Tools)
        {
            function getResumeInfo()
            {
                $search=['id'=>Auth::id()];
                $useApi = new UseApi(); 
                $resumeTools = $useApi->CallApi('GET','api/ResumeTool',$search);
                $resumeCategories = $useApi->CallApi('GET','api/ResumeCategory',$search);
                return array($resumeTools,$resumeCategories);
            }

            list($resumeTools,$resumeCategories)=getResumeInfo();
            foreach($Vacancies as $key=>$Vacancy){
                $score=0;
                $id = $Vacancy['id'];
                $vacancyTool=array_column($Tools[$id],'vacancy_tool');
                $score+=count(array_intersect($vacancyTool,$resumeTools));
                $vacancyCategory=array_column($Categories[$id],'vacancy_category');
                $score+=count(array_intersect($vacancyCategory,$resumeCategories));
                $Vacancies[$key]['score']=$score;
            }
        }
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
            return array($Vacancies,$Categories,$Tools);
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
        // 計算職缺與使用者合適程度
        // 職缺與履歷進行比對 
        // 比對項目:[tool,category]
        calculateSuitableScore($Vacancies,$Categories,$Tools);
        
        return view('user.savework.analysis.show',compact('Vacancies','Categories','Tools','Companies'));
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
        $Eductions = ['不拘','高中','專科','大學','碩士','博士'];
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

        return view('user.savework.analysis.detail',compact('claimExperiences','claimEducations','tools','categories','industryCategories','capitals','workers','resumes','resumeTools','resumeCategories','Eductions','Experiences'));
    }
}
