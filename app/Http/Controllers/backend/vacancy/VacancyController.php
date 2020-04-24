<?php

namespace App\Http\Controllers\backend\vacancy;

use App\Vacancy;
use App\VacancyTool;
use App\VacancyCategory;
use App\VacancyCategoryTag;
use App\VacancyToolTag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Vacancies = Vacancy::orderBy('id')->paginate(10);
        return view('backend.vacancy.list')->with('Vacancies',$Vacancies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $VacancyToolAll = VacancyTool::all();
        $VacancyCategoryAll = VacancyCategory::all();
        return view('backend.vacancy.create',compact('VacancyToolAll','VacancyCategoryAll'));
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
            'vacancy_name'=>'required|max:255',
            'company_name'=>'required|max:255',
            'claim_education'=>'required|max:255',
            'claim_experience'=>'required|max:255',
            'region'=>'required|max:255',
            'area'=>'required|max:255',
        ]);

        $VacancyTools = $request->VacancyTools;
        $VacancyCategories = $request->VacancyCategories;

        $Vacancise = Vacancy::create($request->all()); 
        $Vacancise->tool()->attach($VacancyTools);
        $Vacancise->category()->attach($VacancyCategories);
        $Vacancise->save();

        return redirect('/backend/work/vacancy')->with('success','VacancyTool Create');
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
        $where = array('id' => $id);
        $Vacancies = Vacancy::where($where)->first();
        $VacancyTools = json_decode(Vacancy::find($id)->tool,true);
        $VacancyTools = array_column($VacancyTools,'id');
        $VacancyCategories = json_decode(Vacancy::find($id)->category,true);
        $VacancyCategories = array_column($VacancyCategories,'id');
        $VacancyToolAll = VacancyTool::all();
        $VacancyCategoryAll = VacancyCategory::all();

        return view('backend.vacancy.edit', compact('Vacancies','VacancyTools','VacancyCategories','VacancyToolAll','VacancyCategoryAll'));
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
            'vacancy_name'=>'required|max:255',
            'company_name'=>'required|max:255',
            'claim_education'=>'required|max:255',
            'claim_experience'=>'required|max:255',
            'region'=>'required|max:255',
            'area'=>'required|max:255',
        ]);

        $VacancyTools = $request->VacancyTools;
        $VacancyCategories = $request->VacancyCategories;
        
        $update = ['vacancy_name' => $request->vacancy_name, 'company_name' => $request->company_name,
                    'claim_education' => $request->claim_education,'claim_experience' => $request->claim_experience,
                    'region' => $request->region,'area' => $request->area
                ];
        
        $Vacancise = Vacancy::where('id',$id)->first();
        $Vacancise->update($update);
        $Vacancise->tool()->sync($VacancyTools);
        $Vacancise->category()->sync($VacancyCategories);
        $Vacancise->save();

        return Redirect::to('/backend/work/vacancy')
       ->with('success','Great! Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Vacancise = Vacancy::where('id',$id)->first();
        $Vacancise->tool()->detach();
        $Vacancise->category()->detach();
        $Vacancise->destroy($id);
        $Vacancise->save();
        return Redirect::to('/backend/work/vacancy')->with('success','Product deleted successfully');
    }
}
