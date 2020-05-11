<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tool\UseApi;
use App\Http\Controllers\Tool\setWeight;
use App\Http\Controllers\Statistics\StatisticsMethods;
use App\Http\Controllers\api\WorkController;
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
    private function useApi(){
        $useApi = new UseApi();
        return $useApi;
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
        $useApi = $this->useApi();
        $Vacancies = $useApi->CallApi('GET','api/getVacancies',$search);
        $Categories = $useApi->CallApi('GET','api/getCategories',$search);
        $Tools = $useApi->CallApi('GET','api/getTools',$search);
        return [$Vacancies,$Categories,$Tools];
    }
    private function getAnalysisVacancy($search){
            $useApi =$this->useApi();
            $claimExperiences = $useApi->CallApi('GET','api/claimExperienceCount',$search);
            $claimEducations = $useApi->CallApi('GET','api/claimEducationCount',$search);
            $categories = $useApi->CallApi('GET','api/categoryCount',$search);
            $tools = $useApi->CallApi('GET','api/toolCount',$search);
            return [$claimExperiences,$claimEducations,$categories,$tools];
    }
    private function prepareCategoryAnTool($Vacancies,$categories,$tools){
        $prepareExperience=[];
        $prepareEducation=[];
        $prepareCategories=[];
        $prepareTools=[];
        foreach($categories as $index=>$category){
            foreach($category as $categoryItem){
                $prepareCategories[$categoryItem['vacancy_category']]=$categoryItem['weight'];
            }
            foreach($tools[$index] as $toolItem){
                $prepareTools[$toolItem['vacancy_tool']]=$toolItem['weight'];
            }
        }
        foreach($Vacancies as $Vacancy){
            $prepareExperience[$Vacancy['claim_experience']]=$Vacancy['weight_experience'];
            $prepareEducation[$Vacancy['claim_education']]=$Vacancy['weight_education'];
        }
        return [$prepareExperience,$prepareEducation,$prepareCategories,$prepareTools];
    }
    private function setWeight(){
        $useApi =$this->useApi();
        $useApi->CallApi('GET','api/saveWeight');
    }
    private function computeChartValue($Vacancies,$Categories,$Tools,$resumes,$resumeCategories,$resumeTools,$weight){
        $StatisticsMethods=$this->getStatisticsMethods();
        $value=[];
        $minExperience=min($weight['experience']);
        $minEducation=min($weight['education']);
        foreach ($Vacancies as $Vacancy) {
                if(isset($weight['experience'][$resumes['experience']])){
                    $resumeExperience=$weight['experience'][$resumes['experience']];
                }
                else{
                    $resumeExperience=$minExperience;
                }
                if(isset($weight['education'][$resumes['education']])){
                    $resumeEducation=$weight['education'][$resumes['education']];
                }
                else{
                    $resumeEducation=$minEducation;
                }
                $value[$Vacancy['vacancy_name']]['claim_experience']=$StatisticsMethods->computePercent($resumeExperience,$weight['experience'][$Vacancy['claim_experience']]);
                $value[$Vacancy['vacancy_name']]['claim_education']=$StatisticsMethods->computePercent($resumeEducation,$weight['education'][$Vacancy['claim_education']]);
                $value[$Vacancy['vacancy_name']]['category']=$StatisticsMethods->setSimilar($resumeCategories,array_column($Categories[$Vacancy['id']],'vacancy_category'));
                $value[$Vacancy['vacancy_name']]['tool']=$StatisticsMethods->setSimilar($resumeTools,array_column($Tools[$Vacancy['id']],'vacancy_tool'));
        }
        return $value;
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
            $Vacancies=Vacancy::all('id','vacancy_category','weight_education','weight_experience','claim_education','claim_experience','company_id')->where('vacancy_category',$request->vacancy_category);
        }
        else if($this->isSetSessionWork($request)){
            $Vacancies=Vacancy::all('id','vacancy_category','weight_education','weight_experience','claim_education','claim_experience','company_id');
        }
        else{
            // $useApi =$this->useApi();
            // $workController = $useApi->CallApi('GET','api/saveWeight',[]);
            // dd($workController);
            $workController=new WorkController;
            $workController->saveWeight();
            $Vacancies=Vacancy::all('id','vacancy_category','claim_education','claim_experience','weight_education','weight_experience','company_id');
        }
        $calScore=$this->getCalScore();
        $works=[];
        $weight=[];
        foreach($Vacancies as $Vacancy){
            $works[]=$Vacancy['id'];
        }
        $search = ['works'=>$works];
        $Companies=getCompanyInfo($Vacancies);
        list($Vacancies,$Categories,$Tools)=$this->getVacancyInfo($search);
        list($weight['experience'],$weight['education'],$weight['category'],$weight['tool'])=$this->prepareCategoryAnTool($Vacancies,$Categories,$Tools);
        $score=$calScore->calScore($Vacancies,$Categories,$Tools,$weight);
        // 取得職缺對應的公司名稱
        return view('user.savework.index',compact('Vacancies','Companies','score'));
    }
    public function form(Request $request)
    {
        function getCompanyInfo($search)
        {
            $useApi = new useApi;
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
        $weight=[];
        $search = ['works'=>$works];
        // 取得職缺資訊
        list($Vacancies,$Categories,$Tools)=$this->getVacancyInfo($search);
        list($weight['experience'],$weight['education'],$weight['category'],$weight['tool'])=$this->prepareCategoryAnTool($Vacancies,$Categories,$Tools);
        // 取得公司資訊
        $Companies=getCompanyInfo($search);
        // 計算職缺與使用者合適程度 & 取得使用者履歷資訊
        list($resumeTools,$resumeCategories,$resume)=$this->getResumeInfo();
        $score=$calScore->calScore($Vacancies,$Categories,$Tools,$weight);
        // 職缺與履歷進行比對 
        // 比對項目:[claim_education,tool,category]
        return view('user.savework.analysis.show',compact('Vacancies','Categories','Tools','Companies','resume','resumeTools','resumeCategories','score'));
    }
    
    public function detail(Request $request)
    {
        
        function getAnalysisCompany($search)
        {
            $useApi =new useApi; 
            $industryCategories = $useApi->CallApi('GET','api/industryCategoryCount',$search);
            $capitals = $useApi->CallApi('GET','api/capital',$search);
            $workers = $useApi->CallApi('GET','api/workers',$search);
            return array($industryCategories,$capitals,$workers);
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
        list($claimExperiences,$claimEducations,$categories,$tools) =$this->getAnalysisVacancy($search);
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
        $this->getStatisticsMethods();
        $weight=[];
        $value=[];
        $calScore=$this->getCalScore();
        $search = ['works'=>$works];
        list($Vacancies,$Categories,$Tools)=$this->getVacancyInfo($search);
        list($weight['experience'],$weight['education'],$weight['category'],$weight['tool'])=$this->prepareCategoryAnTool($Vacancies,$Categories,$Tools);
        list($resumes,$resumeTools,$resumeCategories) = $this->getResumeInfo();
        $value=$this->computeChartValue($Vacancies,$Categories,$Tools,$resumes,$resumeCategories,$resumeTools,$weight);
        $score=$calScore->calScore($Vacancies,$Categories,$Tools,$weight);
        foreach($Vacancies as $key=>$Vacancy){
            $name=$Vacancy['vacancy_name'];
            $value[$name]['score']=(int)($score[$key]*100);
        }
        return view('user.savework.analysis.suitable',compact('value'));
    }
}
