<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->name('api.')->group(function() {
    //Company------------------------------------------------------------------------
    Route::get('get_companies','api\CompanyController@get_companies');
    Route::get('industryCategoryCount','api\CompanyController@getIndustryCategoryCount');
    Route::get('capital','api\CompanyController@getCapital');
    Route::get('workers','api\CompanyController@getWorkers');
    //Vacancy------------------------------------------------------------------------
    Route::get('getVacancy','api\WorkController@getVacancy');
    Route::get('getCategories','api\WorkController@getCategories');
    Route::get('getTools','api\WorkController@getTools');
    //StatisticsVacancy------------------------------------------------------------------------
    Route::get('claimEducationCount','api\StatisticsWorksController@getVacancyClaimEducationCount');
    Route::get('claimExperienceCount','api\StatisticsWorksController@getVacancyClaimExperienceCount');
    Route::get('categoryCount','api\StatisticsWorksController@getCategoryCount');
    Route::get('toolCount','api\StatisticsWorksController@getToolCount');
    //Resume------------------------------------------------------------------------
    Route::get('Resume','api\ResumeController@getResume');
    Route::get('ResumeTool','api\ResumeController@getResumeTool');
    Route::get('ResumeCategory','api\ResumeController@getResumeCategory');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->prefix('user')->name('user.')->group(function() {
    Route::get('saveWork','WorkAnalysisController@index')->name('saveWork');
    Route::resource('resume','ResumeController');
});

Route::middleware(['auth'])->prefix('analysis')->name('analysis.')->group(function() {
    Route::get('list','WorkAnalysisController@form')->name('list');
    Route::post('list','WorkAnalysisController@form')->name('list');
    Route::get('detail','WorkAnalysisController@detail')->name('detail');
});

