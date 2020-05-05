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

Route::get('/test', function () {
    return view('frontend/analysis');
});
Route::get('/page','PageController@index');

Route::prefix('api')->name('api.')->group(function() {
    //Company------------------------------------------------------------------------
    Route::get('get_companies','api\CompanyController@get_companies');
    Route::get('industryCategoryCount','api\CompanyController@getIndustryCategoryCount');
    Route::get('capital','api\CompanyController@getCapital');
    Route::get('workers','api\CompanyController@getWorkers');
    //Vacancy------------------------------------------------------------------------
    Route::get('getVacancies','api\WorkController@getVacancies');
    Route::get('getCategories','api\WorkController@getCategories');
    Route::get('getTools','api\WorkController@getTools');
    Route::get('getResumeId','api\WorkController@getResumeId');
    Route::get('claimEducationCount','api\WorkController@getVacancyClaimEducationCount');
    Route::get('claimExperienceCount','api\WorkController@getVacancyClaimExperienceCount');
    Route::get('categoryCount','api\WorkController@getCategoryCount');
    Route::get('toolCount','api\WorkController@getToolCount');
    //Resume------------------------------------------------------------------------
    Route::get('Resume','api\ResumeController@getResume');
    Route::get('ResumeTool','api\ResumeController@getResumeTool');
    Route::get('ResumeCategory','api\ResumeController@getResumeCategory');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->prefix('user')->name('user.')->group(function() {
    Route::get('web','backend\vacancy\FrontendController@index')->name('web');
    Route::resource('resume','ResumeController');
});

Route::middleware(['auth'])->prefix('analysis')->name('analysis.')->group(function() {
    Route::get('list','backend\vacancy\FrontendController@form')->name('list');
    Route::post('list','backend\vacancy\FrontendController@form')->name('list');
    Route::get('detail','backend\vacancy\FrontendController@detail')->name('detail');
});

