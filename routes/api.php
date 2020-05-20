<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getCompanies','api\CompanyController@getCompanies');
    Route::get('capital','api\CompanyController@getCapital');
    Route::get('workers','api\CompanyController@getWorkers');
    //AnalysisCompanyController------------------------------------------------------
    Route::get('industryCategoryCount','api\AnalysisCompanyController@getIndustryCategoryCount');
    //Vacancy------------------------------------------------------------------------
    Route::get('getVacancies','api\WorkController@getVacancies');
    Route::get('getCategories','api\WorkController@getCategories');
    Route::get('getTools','api\WorkController@getTools');
    Route::get('saveWeight','api\WorkController@saveWeight');
    //AnalysisWork-------------------------------------------------------------------
    Route::get('claimEducationCount','api\AnalysisWorkController@getVacancyClaimEducationCount');
    Route::get('claimExperienceCount','api\AnalysisWorkController@getVacancyClaimExperienceCount');
    Route::get('categoryCount','api\AnalysisWorkController@getCategoryCount');
    Route::get('toolCount','api\AnalysisWorkController@getToolCount');
    //Resume-------------------------------------------------------------------------
    Route::get('Resume','api\ResumeController@getResume');
    Route::get('ResumeTool','api\ResumeController@getResumeTool');
    Route::get('ResumeCategory','api\ResumeController@getResumeCategory');
