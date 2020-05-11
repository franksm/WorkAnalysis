<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Tool\MathTool;
use Phpml\Clustering\KMeans;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tool\UseApi;
use App\Http\Controllers\Statistics\StatisticsMethods;
use App\Vacancy;
use App\Http\Controllers\Tool\CalScore;
use Redirect;

class WorkAnalysisController extends Controller
{
    private function getCalScore(){
        $calScore=new CalScore;
        return $calScore;
    }
    private function getStatisticsMethods(){
        $StatisticsMethods=new StatisticsMethods;
        return $StatisticsMethods;
    }
    private function getResumeInfo()
    {
        $useApi = new UseApi();
        $search=['id'=>Auth::id()];
        $resumes = $useApi->CallApi('GET','api/Resume',$search);
        $resumeTools = $useApi->CallApi('GET','api/ResumeTool',$search);
        $resumeCategories = $useApi->CallApi('GET','api/ResumeCategory',$search);
        return array($resumes,$resumeTools,$resumeCategories);
    }
    private function isSetSessionWork($request)
    {
        return $request->session()->has('works');
    }
    private function getVacancyInfo($search){
        $useApi = new UseApi();
        $Vacancies = $useApi->CallApi('GET','api/getVacancies',$search);
        $Categories = $useApi->CallApi('GET','api/getCategories',$search);
        $Tools = $useApi->CallApi('GET','api/getTools',$search);
        return [$Vacancies,$Categories,$Tools];
    }
    public function index(Request $request){ 
        function getCompanyInfo($Vacancies)
        {
            $Companies=[];
            foreach($Vacancies as $Vacancy){
                $Companies[$Vacancy->company->id]=$Vacancy->company->toarray();
            }
            return $Companies;
        }
        
        function isSetCategory($request)
        {
            return $request->vacancy_category;
        }
        // 判斷職缺分類

        if(isSetCategory($request)){
            $Vacancies=Vacancy::all('id','vacancy_name','vacancy_category','company_id','claim_education','claim_experience','link')->where('vacancy_category',$request->vacancy_category);
        }else{
            $Vacancies=Vacancy::all('id','vacancy_name','vacancy_category','company_id','claim_education','claim_experience','link');
        }
        $calScore=$this->getCalScore();
        $works=[];
        $Companies=getCompanyInfo($Vacancies);
        foreach ($Vacancies as $Vacancy) {
            $works[]=$Vacancy->id;
        }
        $search = ['works'=>$works];
        list($Vacancies,$Categories,$Tools)=$this->getVacancyInfo($search);
        $score=$calScore->calScore($Vacancies,$Categories,$Tools);
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
        function isPost($request)
        {
            return $request->isMethod('post');
        }
        // 取得資料
        if(isPost($request)){
            $works=$request->works;
            session(['works' =>$works]);
        }
        else if($this->isSetSessionWork($request)){
            $works=session('works');
        }else{
            return Redirect::to('/user/saveWork/');
        }
        $calScore=$this->getCalScore();
        // 設定Api參數
        $search = ['works'=>$works];
        // 取得職缺資訊
        list($Vacancies,$Categories,$Tools)=$this->getVacancyInfo($search);
        // 取得公司資訊
        $Companies=getCompanyInfo($search);
        // 計算職缺與使用者合適程度 & 取得使用者履歷資訊
        list($resumeTools,$resumeCategories,$resume)=$this->getResumeInfo();
        $score=$calScore->calScore($Vacancies,$Categories,$Tools);
        // 職缺與履歷進行比對 
        // 比對項目:[claim_education,tool,category]
        //compact裡的項目->'sortVacancy'
        return view('user.savework.analysis.show',compact('Vacancies','Categories','Tools','Companies','resume','resumeTools','resumeCategories','score'));
    }
    
    public function detail(Request $request)
    {
        
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
        

        // 教育與經歷清單
        $Educations = ['不拘','高中','專科','大學','碩士','博士'];
        $Experiences = ['不拘','1年','2年','3年','4年','5年','6年','7年','8年','9年','10年'];
        // 取得資料
        if($this->isSetSessionWork($request)){
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
        list($resumes,$resumeTools,$resumeCategories) = $this->getResumeInfo();

        return view('user.savework.analysis.detail',compact('claimExperiences','claimEducations','tools','categories','industryCategories','capitals','workers','resumes','resumeTools','resumeCategories','Educations','Experiences'));
    }
    public function suitable(Request $request)
    {
        if($this->isSetSessionWork($request)){
            $works=session('works');
        }else{
            return Redirect::to('/user/saveWork/');
        }
        $calScore=$this->getCalScore();
        $StatisticsMethods=$this->getStatisticsMethods();
        $search = ['works'=>$works];
        $value=[];
        list($resumes,$resumeTools,$resumeCategories) = $this->getResumeInfo();
        list($Vacancies,$Categories,$Tools)=$this->getVacancyInfo($search);
        $scoreRule=$StatisticsMethods->setScore();
        $claimEducation=[$scoreRule['educations'][$resumes['education']]];
        $claimExperience=[$scoreRule['experiences'][$resumes['experience']]];
        foreach($Vacancies as $Vacancy){
            $claimEducation[]=$scoreRule['educations'][$Vacancy['claim_education']];
            $claimExperience[]=$scoreRule['experiences'][$Vacancy['claim_experience']];
        }
        $maxEducation=max($claimEducation);
        $maxExperience=max($claimExperience);
        $minEducation=min($claimEducation);
        $minExperience=min($claimExperience);
        foreach($Vacancies as $Vacancy){
            $name=$Vacancy['vacancy_name'];
            $value[$name]['category']=$StatisticsMethods->setSimilar(array_column($Categories[$Vacancy['id']],'vacancy_category'),$resumeCategories);
            $value[$name]['tool']=$StatisticsMethods->setSimilar(array_column($Tools[$Vacancy['id']],'vacancy_tool'),$resumeTools);
            $value[$name]['claim_education']=(int)($StatisticsMethods->meanNormalization($scoreRule['educations'][$Vacancy['claim_education']],$claimEducation,$maxEducation,$minEducation)*100);
            $value[$name]['claim_experience']=(int)($StatisticsMethods->meanNormalization($scoreRule['experiences'][$Vacancy['claim_experience']],$claimExperience,$maxExperience,$minExperience)*100);
        }
        $score=$calScore->calScore($Vacancies,$Categories,$Tools);
        foreach($Vacancies as $key=>$Vacancy){
            $name=$Vacancy['vacancy_name'];
            $value[$name]['score']=(int)(($score[$key]+1)*50);
        }
        return view('user.savework.analysis.suitable',compact('value'));
    }
}
