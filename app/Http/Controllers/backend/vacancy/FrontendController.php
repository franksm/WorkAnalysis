<?php

namespace App\Http\Controllers\backend\vacancy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Vacancy;
use App\VacancyCategory;
class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    # /web?job_type=工程
    public function index(Request $request)
    {
        if(isset($request->vacancy_category)){
            $Vacancies= Vacancy::all()->where('vacancy_category',$request->vacancy_category);
        }else{
            $Vacancies= Vacancy::all();
        }
        $Companies=[];
        foreach($Vacancies as $Vacancy){
            $Companies[$Vacancy->id]=$Vacancy->company;
        }
        $VacancyCategoties=VacancyCategory::all();
        return view('frontend.index')->with('Vacancies',$Vacancies)->with('Companies',$Companies)->with('VacancyCategoties',$VacancyCategoties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request=$request->all();
        $Vacancies=Vacancy::all()->find($request['works']);
        $Tools=[];
        $Categories=[];
        $Companies=[];
        foreach($Vacancies as $Vacancy){
            $Companies[$Vacancy->id]=$Vacancy->company->toarray();
            $Categories[$Vacancy->id]=$Vacancy->category->toarray();
            $Tools[$Vacancy->id]=$Vacancy->tool->toarray();
        }
        // dd($Vacancies->pluck('salary'));
        return view('frontend.show',compact('Vacancies','Categories','Tools','Companies'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
