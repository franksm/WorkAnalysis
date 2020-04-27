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
