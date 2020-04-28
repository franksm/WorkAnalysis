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
    Route::get('get_vacancies','api\WorkController@get_vacancies');
    Route::get('get_categories','api\WorkController@get_categories');
    Route::get('get_tools','api\WorkController@get_tools');
    Route::get('get_companies','api\WorkController@get_companies');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->prefix('backend')->name('backend.')->group(function() {
    Route::middleware(['auth'])->prefix('work')->name('work.')->group(function() {
        Route::get('/', function () {
            return view('backend/vacancy/index');
        });
        Route::resource('web','backend\vacancy\FrontendController');
        Route::resource('vacancy','backend\vacancy\VacancyController');
        Route::resource('tool','backend\vacancy\ToolController');
        Route::resource('category','backend\vacancy\CategoryController');
    });
});
