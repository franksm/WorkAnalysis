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
        $VacancyCategorys = VacancyCategory::orderBy('id','desc')->paginate(10);
        return view('backend.vacancy.category.list')->with('VacancyCategorys',$VacancyCategorys);
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
        $VacancyCategorys = new VacancyCategory;
        $VacancyCategorys->vacancy_category=$request->vacancy_category;
        $VacancyCategorys->save();
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
        $VacancyCategorys = VacancyCategory::find($id);
        return view('VacancyCategory.showVacancyCategory')->with('VacancyCategorys',$VacancyCategorys);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $VacancyCategorys = VacancyCategory::find($id);
        return view('backend.vacancy.category.edit')->with('VacancyCategorys',$VacancyCategorys);
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
        $VacancyCategorys = VacancyCategory::find($id);
        $VacancyCategorys->vacancy_category=$request->vacancy_category;
        $VacancyCategorys->save();
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
        $VacancyCategorys=VacancyCategory::find($id);
        $VacancyCategorys->vacancy()->detach();
        $VacancyCategorys->destroy($id);
        $VacancyCategorys->save();
        return redirect('/VacancyCategory')->with('success','VacancyCategory Removed'); 
    }
}
