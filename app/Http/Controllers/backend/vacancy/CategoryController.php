<?php

namespace App\Http\Controllers\backend\vacancy;

use App\VacancyCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $VacancyCategories = VacancyCategory::orderBy('id','desc')->paginate(10);
        return view('backend.vacancy.category.list')->with('VacancyCategorys',$VacancyCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vacancy.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'vacancy_category'=>'required|max:255',
        ]);
        $VacancyCategories = new VacancyCategory;
        $VacancyCategories->vacancy_category=$request->vacancy_category;
        $VacancyCategories->save();
        return redirect('/backend/work/category')->with('success','VacancyCategory Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $VacancyCategories = VacancyCategory::find($id);
        return view('VacancyCategory.showVacancyCategory')->with('VacancyCategorys',$VacancyCategories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $VacancyCategories = VacancyCategory::find($id);
        return view('backend.vacancy.category.edit')->with('VacancyCategorys',$VacancyCategories);
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
        $this->validate($request,[
            'vacancy_category'=>'required|max:255',
        ]);
        $VacancyCategories = VacancyCategory::find($id);
        $VacancyCategories->vacancy_category=$request->vacancy_category;
        $VacancyCategories->save();
        return redirect('/backend/work/category')->with('success','VacancyCategory Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $VacancyCategories=VacancyCategory::find($id);
        $VacancyCategories->vacancy()->detach();
        $VacancyCategories->destroy($id);
        $VacancyCategories->save();
        return redirect('/VacancyCategory')->with('success','VacancyCategory Removed'); 
    }
}
