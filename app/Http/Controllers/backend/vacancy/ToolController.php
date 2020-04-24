<?php

namespace App\Http\Controllers\backend\vacancy;

use App\VacancyTool;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $VacancyTools = VacancyTool::orderBy('id','desc')->paginate(10);
        return view('backend.vacancy.tool.list')->with('VacancyTools',$VacancyTools);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vacancy.tool.create');
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
            'vacancy_tool'=>'required|max:255',
        ]);
        $VacancyTools = new VacancyTool;
        $VacancyTools->vacancy_tool=$request->vacancy_tool;
        $VacancyTools->save();
        return redirect('/backend/work/tool')->with('success','VacancyTool Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $VacancyTools = VacancyTool::find($id);
        return view('VacancyTool.showVacancyTool')->with('VacancyTools',$VacancyTools);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $VacancyTools = VacancyTool::find($id);
        return view('backend.vacancy.tool.edit')->with('VacancyTools',$VacancyTools);
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
            'vacancy_tool'=>'required|max:255',
        ]);
        $VacancyTools = VacancyTool::find($id);
        $VacancyTools->vacancy_tool=$request->vacancy_tool;
        $VacancyTools->save();
        return redirect('/backend/work/tool')->with('success','VacancyTool Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $VacancyTools=VacancyTool::find($id);
        $VacancyTools->vacancy()->detach();
        $VacancyTools->destroy($id);
        $VacancyTools->save();
        return redirect('/VacancyTool')->with('success','VacancyTool Removed'); 
    }
}
