<?php

namespace App\Http\Controllers;

use App\Resume;
use App\Vacancy;
use App\VacancyCategory;
use App\VacancyTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class ResumeController extends Controller
{
    public function index()
    {
        $Resume = Resume::where(['user_id' => Auth::id()])->first();
        $UserId = Auth::id();
        if($Resume==null){
            return Redirect::to('/user/resume/create');
        }else{
            //dd($UserId);
            return Redirect::to('user/resume/'.$UserId.'/edit');
        }
    }
    public function create()
    {
        $CategoryAll = VacancyCategory::all();
        $ToolAll = VacancyTool::all();
        return view('user/resume/create',compact('CategoryAll','ToolAll'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'born' => 'required',
        ]);
        $request['user_id']=Auth::id();
        $Categories = $request->categories;
        $Tools = $request->tools;

        $Resume = Resume::create($request->all()); 
        $Resume->category()->attach($Categories);
        $Resume->tool()->attach($Tools);
        $Resume->save();
        
        return Redirect::to('/home')
       ->with('success','Greate! Product created successfully.');
    }

    public function edit($UserId)
    {
        $Resume = Resume::where(['user_id'=>$UserId])->first();
        $Categories = json_decode(Resume::find($Resume->id)->category,true);
        $Categories = array_column($Categories,'id');
        $Tools = json_decode(Resume::find($Resume->id)->tool,true);
        $Tools = array_column($Tools,'id');
        $CategoryAll = VacancyCategory::all();
        $ToolAll = VacancyTool::all();
        return view('user/resume/edit',compact('Resume','Categories','Tools','CategoryAll','ToolAll'));
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
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'born' => 'required',
        ]);
         
        $Categories = $request->categories;
        $Tools = $request->tools;
        
        $update = ['name' => $request->name, 'age' => $request->age,'born' => $request->born,
                    'eduction'=>$request->eduction,'experience'=>$request->experience];
        $Resume = Resume::where('id',$id)->first();
        $Resume->update($update);
        $Resume->category()->sync($Categories);
        $Resume->tool()->sync($Tools);
        $Resume->save();

        return Redirect::to('/home')
       ->with('success','Great! Product updated successfully');
        
    }
}
