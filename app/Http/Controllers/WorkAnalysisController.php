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
use App\Http\Controllers\Tool\Tool;
use App\Http\Controllers\api\WorkController;
use App\Http\Controllers\api\ResumeController;
use App\Vacancy;
use App\Http\Controllers\Tool\GetScore;
use Redirect;
class WorkAnalysisController extends Controller
{
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

    private function isSetSessionScore($request)
    {
        return $request->session()->has('score');
    }

    private function getVacancyInfo($search){
        $useApi = $this->useApi();
        $Vacancies = $useApi->CallApi('GET','api/getVacancies',$search);
        $Categories = $useApi->CallApi('GET','api/getCategories',$search);
        $Tools = $useApi->CallApi('GET','api/getTools',$search);
        return [$Vacancies,$Categories,$Tools];
    }

    private function checkResumeInWork(){
        $checkResume=new ResumeController;
        $search=Auth::id();
        return $checkResume->checkResume($search);
    }

    private function getAnalysisVacancy($search){
            $useApi =$this->useApi();
            $claimExperiences = $useApi->CallApi('GET','api/claimExperienceCount',$search);
            $claimEducations = $useApi->CallApi('GET','api/claimEducationCount',$search);
            $categories = $useApi->CallApi('GET','api/categoryCount',$search);
            $tools = $useApi->CallApi('GET','api/toolCount',$search);
            return [$claimExperiences,$claimEducations,$categories,$tools];
    }
    
    private function setWeight(){
        $useApi =$this->useApi();
        $useApi->CallApi('GET','api/saveWeight');
    }
    private function computeChartValue($Vacancies,$resume){
        $StatisticsMethods=new StatisticsMethods();
        $setScore=$StatisticsMethods->setScore();
        foreach ($Vacancies as $index=>$Vacancy) {
            $value[$Vacancy['vacancy_name']]['claim_experience']=round($StatisticsMethods->computePercent($setScore['experience'][$Vacancy['claim_experience']],$setScore['experience'][$resume['experience']]),2);
            $value[$Vacancy['vacancy_name']]['claim_education']=round($StatisticsMethods->computePercent($setScore['education'][$Vacancy['claim_education']],$setScore['education'][$resume['education']]),2);
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
            $Vacancies=Vacancy::all('id','vacancy_category','company_id')->where('vacancy_category',$request->vacancy_category);
        }
        else if($this->isSetSessionWork($request)){
            $Vacancies=Vacancy::all('id','vacancy_category','company_id');
        }
        else{
            $workController=new WorkController;
            $workController->saveWeight();
            $Vacancies=Vacancy::all('id','vacancy_category','company_id');
        }
        $getScore=new GetScore;
        $works=[];
        foreach($Vacancies as $Vacancy){
            $works[]=$Vacancy['id'];
        }
        $search = ['works'=>$works];
        $Companies=getCompanyInfo($Vacancies);
        list($Vacancies,$Categories,$Tools)=$this->getVacancyInfo($search);
        if ($this->checkResumeInWork()!=null){
            $score=$getScore->getScore($Vacancies,$Categories,$Tools);
        }
        else{
            $score=$Vacancies;
        }
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
        }
        else if($this->isSetSessionScore($request)){
            $score=session('score');
        }
        else{
            return Redirect::to('/user/saveWork/');
        }
        $getScore=new GetScore;
        // 設定Api參數
        $search = ['works'=>$works];
        // 取得職缺資訊
        list($Vacancies,$Categories,$Tools)=$this->getVacancyInfo($search);
        // 取得公司資訊
        $Companies=getCompanyInfo($search);
        // 計算職缺與使用者合適程度 & 取得使用者履歷資訊
        if ($this->checkResumeInWork()!=null){
            list($resume,$resumeTools,$resumeCategories)=$this->getResumeInfo();
            $score=$getScore->getScore($Vacancies,$Categories,$Tools);
        }
        else{
            $resume=[];
            $resumeTools=[];
            $resumeCategories=[];
            $score=$Vacancies;
        }
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
        if ($this->checkResumeInWork()!=null){
            list($resumes,$resumeTools,$resumeCategories)=$this->getResumeInfo();
            $resumeTools = array_column($resumeTools,'vacancy_tool');
            $resumeCategories = array_column($resumeCategories,'vacancy_category');
        }
        else{
            $resumes['experience']=[];
            $resumes['education']=[];
            $resumeTools=[];
            $resumeCategories=[];
        }
        return view('user.savework.analysis.detail',compact('claimExperiences','claimEducations','tools','categories','industryCategories','capitals','workers','resumes','resumeTools','resumeCategories','Educations','Experiences'));
    }
    public function suitable(Request $request)
    {
        function coefficient($useField,$usePearson){
            if ($usePearson==null){
                return round($useField*100,2);
            }
            else{
                return round(($useField+1)*50,2);
            }
        }
        if($this->isSetSessionWork($request)){
            $works=session('works');
        }else{
            return Redirect::to('/user/saveWork/');
        }
        $statisticsTool=new Tool();
        $type=$request->type;
        $value=[];
        $getScore=new GetScore;
        $search = ['works'=>$works];
        list($Vacancies,$categories,$Tools)=$this->getVacancyInfo($search);
        if ($this->checkResumeInWork()!=null){
            list($resumes,$resumeTool,$resumeCategory) = $this->getResumeInfo();
            $handleCategory=$statisticsTool->handleData($categories,'vacancy_category',$resumeCategory);
            $handleTools=$statisticsTool->handleData($Tools,'vacancy_tool',$resumeTool);
            $value=$this->computeChartValue($Vacancies,$resumes);
            if($type==null){
                $prepareCategories=$handleCategory;
                $prepareTools=$handleTools;
            }
            else{
                $prepareCategories=$statisticsTool->pearson($handleCategory);
                $prepareTools=$statisticsTool->pearson($handleTools);
            }
            $score=$getScore->getScore($Vacancies,$categories,$Tools,$type);
            $resumeTool=array_pop($prepareTools);
            $resumeCategory=array_pop($prepareCategories);
            foreach($Vacancies as $key=>$Vacancy){
                $tool=$statisticsTool->computeCosine($prepareTools[$key],$resumeTool);
                $category=$statisticsTool->computeCosine($prepareCategories[$key],$resumeCategory);
                $value[$Vacancy['vacancy_name']]['tool']=coefficient($tool,$type);
                $value[$Vacancy['vacancy_name']]['category']=coefficient($category,$type);
                $value[$Vacancy['vacancy_name']]['score']=coefficient($score[$key],$type);
            }
        }
        else{
            foreach($Vacancies as $Vacancy){
                $value[$Vacancy['vacancy_name']]['tool']=0;
                $value[$Vacancy['vacancy_name']]['category']=0;
                $value[$Vacancy['vacancy_name']]['score']=0;
            }
        }
        return view('user.savework.analysis.suitable',compact('value'));
    }
}
