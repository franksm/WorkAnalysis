<?php

namespace App\Http\Controllers\api;

use App\Company;
use App\Vacancy;
use App\Resume;
use App\VacancyCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="My First API", version="0.1")
 */

class WorkController extends Controller
{
    /**
     * @OA\GET(
     *     path="/api/getVacancies",
     *     tags={"給我職缺資訊"},
     *     summary="取得職缺資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getVacancies(Request $request)
    {
        $works=$request->works;
        $vacancies=Vacancy::all()->find($works);
        return $vacancies;
    }
    public function getResumeId(Request $request)
    {
        $userId=$request->id;
        $Resume = Resume::select('user_id')->find($userId);
        return $Resume;
    }
    /**
     * @OA\GET(
     *     path="/api/getCategories",
     *     tags={"給我職缺資訊"},
     *     summary="取得職缺種類資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getCategories(Request $request)
    {
        $works=$request->works;
        $vacancies=Vacancy::select('id')->find($works);
        $Categories=[];
        foreach($vacancies as $vacancy){
            $Categories[$vacancy->id]=$vacancy->category->toarray();
        }
        return $Categories;
    }
    /**
     * @OA\GET(
     *     path="/api/get_tools",
     *     tags={"給我職缺資訊"},
     *     summary="取得職缺需求工具資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getTools(Request $request)
    {
        $works=$request->works;
        $vacancies=Vacancy::select('id')->find($works);
        $tools=[];
        foreach($vacancies as $vacancy){
            $tools[$vacancy->id]=$vacancy->tool->toarray();
        }
        return $tools;
    }
    /**
     * @OA\GET(
     *     path="/api/categoryCount",
     *     tags={"給我職缺資訊"},
     *     summary="取得種類統計分析資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getCategoryCount(Request $request)
    {
        $works=$request->works;
        $vacancies=Vacancy::select('id','vacancy_name','company_id','link')->find($works);
        $categoryCount=[];
        foreach($vacancies as $vacancy){
            $category=$vacancy->category->toarray();
            $company=$vacancy->company->all('id','company_name','link')->where('id',$vacancy->company_id)->toarray();
            $companyContent=array_pop($company);
            foreach($category as $categoryItem){
                if (isset($categoryCount[$categoryItem['vacancy_category']]['percentage'])){
                    $categoryCount[$categoryItem['vacancy_category']]['percentage']++;
                }
                else{
                    $categoryCount[$categoryItem['vacancy_category']]['percentage']=1;
                }
                $categoryCount[$categoryItem['vacancy_category']]['vacancy'][$vacancy->id]['vacancy_name']=$vacancy->vacancy_name;
                $categoryCount[$categoryItem['vacancy_category']]['vacancy'][$vacancy->id]['vacancy_link']=$vacancy->link;
                $categoryCount[$categoryItem['vacancy_category']]['vacancy'][$vacancy->id]['company_name']=$companyContent['company_name'];
                $categoryCount[$categoryItem['vacancy_category']]['vacancy'][$vacancy->id]['company_link']=$companyContent['link'];
            }
        }
        foreach($categoryCount as $category => $count){
            $categoryCount[$category]['percentage']=round($count['percentage']/count($works)*100,1);
        }
        return $categoryCount;
    }
    /**
     * @OA\GET(
     *     path="/api/claimEducationCount",
     *     tags={"給我職缺資訊"},
     *     summary="取得需求學歷分析資訊",

     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */

    public function getVacancyClaimEducationCount(Request $request)
    {
        $works=$request->works;
        $vacancies=Vacancy::select('id','vacancy_name','claim_education','company_id','link')->find($works);
        $claimEducationCount=[];
        foreach($vacancies as $vacancy){
                $company=$vacancy->company->all('id','company_name','link')->where('id',$vacancy->company_id)->toarray();
                $companyContent=array_pop($company);
                if (isset($claimEducationCount[$vacancy->claim_education]['percentage'])){
                    $claimEducationCount[$vacancy->claim_education]['percentage']++;
                }
                else{
                    $claimEducationCount[$vacancy->claim_education]['percentage']=1;
                }
                $claimEducationCount[$vacancy->claim_education]['vacancy'][$vacancy->id]['vacancy_name']=$vacancy->vacancy_name;
                $claimEducationCount[$vacancy->claim_education]['vacancy'][$vacancy->id]['vacancy_link']=$vacancy->link;
                $claimEducationCount[$vacancy->claim_education]['vacancy'][$vacancy->id]['company_name']=$companyContent['company_name'];
                $claimEducationCount[$vacancy->claim_education]['vacancy'][$vacancy->id]['company_link']=$companyContent['link'];
        }
        foreach($claimEducationCount as $education => $count){
            $claimEducationCount[$education]['percentage']=round($count['percentage']/count($works)*100,1); 
        }
        return $claimEducationCount;
    }
    /**
     * @OA\GET(
     *     path="/api/claimExperienceCount",
     *     tags={"給我職缺資訊"},
     *     summary="取得工作經歷分析資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function getVacancyClaimExperienceCount(Request $request)
    {
        $works=$request->works;
        $vacancies=Vacancy::select('id','vacancy_name','claim_experience','company_id','link')->find($works);
        $claimExperienceCount=[];
        foreach($vacancies as $vacancy){
            $company=$vacancy->company->all('id','company_name','link')->where('id',$vacancy->company_id)->toarray();
            $companyContent=array_shift($company);
                if (isset($claimExperienceCount[$vacancy->claim_experience]['percentage'])){
                    $claimExperienceCount[$vacancy->claim_experience]['percentage']++;
                }
                else{
                    $claimExperienceCount[$vacancy->claim_experience]['percentage']=1;
                }
                $claimExperienceCount[$vacancy->claim_experience]['vacancy'][$vacancy->id]['vacancy_name']=$vacancy->vacancy_name;
                $claimExperienceCount[$vacancy->claim_experience]['vacancy'][$vacancy->id]['vacancy_link']=$vacancy->link;
                $claimExperienceCount[$vacancy->claim_experience]['vacancy'][$vacancy->id]['company_name']=$companyContent['company_name'];
                $claimExperienceCount[$vacancy->claim_experience]['vacancy'][$vacancy->id]['company_link']=$companyContent['link'];
        }
        foreach($claimExperienceCount as $Experience => $Count){
            $claimExperienceCount[$Experience]['percentage']=round($Count['percentage']/count($works)*100,1); 
        }
        return $claimExperienceCount;
    }
    
     /**
     * @OA\GET(
     *     path="/api/toolCount",
     *     tags={"給我職缺資訊"},
     *     summary="取得工具統計分析資訊",
     *     description="請給我對應的id",
     *     @OA\Parameter(name="works[]", in="query",@OA\Schema(type="array",@OA\Items(type="integer")), required=true, description="請輸入查詢id"),
     *     @OA\Response(
     *      response="200",
     *      description="請求成功"
     *     )
     * )
     */
    public function gettoolCount(Request $request){
        $works=$request->works;
        $vacancies=Vacancy::all()->find($works);
        $toolCount=[];
        foreach($vacancies as $vacancy){
            $Tool=$vacancy->tool->toarray();
            $company=$vacancy->company->all('id','company_name','link')->where('id',$vacancy->company_id)->toarray();
            $companyContent=array_pop($company);
            foreach($Tool as $ToolItem){
                if (isset($toolCount[$ToolItem['vacancy_tool']]['percentage'])){
                    $toolCount[$ToolItem['vacancy_tool']]['percentage']++;
                }
                else{
                    $toolCount[$ToolItem['vacancy_tool']]['percentage']=1;
                }
                $toolCount[$ToolItem['vacancy_tool']]['vacancy'][$vacancy->id]['vacancy_name']=$vacancy->vacancy_name;
                $toolCount[$ToolItem['vacancy_tool']]['vacancy'][$vacancy->id]['vacancy_link']=$vacancy->link;
                $toolCount[$ToolItem['vacancy_tool']]['vacancy'][$vacancy->id]['company_name']=$companyContent['company_name'];
                $toolCount[$ToolItem['vacancy_tool']]['vacancy'][$vacancy->id]['company_link']=$companyContent['link'];
            }
        }
        foreach($toolCount as $Tool => $Count){
            $toolCount[$Tool]['percentage']=round($Count['percentage']/count($works)*100,1);
        }
        return $toolCount;
    }

}
