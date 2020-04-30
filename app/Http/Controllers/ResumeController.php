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
        return view('frontend/resume/index');
    }
    public function create()
    {
        $CategoryAll = VacancyCategory::all();
        $ToolAll = VacancyTool::all();
        return view('frontend/resume/create',compact('CategoryAll','ToolAll'));
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
        
        return Redirect::to('/user/resume/')
       ->with('success','Greate! Product created successfully.');
    }
}
