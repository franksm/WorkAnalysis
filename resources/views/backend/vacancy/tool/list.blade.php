@extends('layouts.app')
@section('header_title', 'Tool List')
@section('content')
<div class="container">
<div class="col-12">
  <a href="{{ route('backend.work.tool.create') }}" class="btn btn-success mb-2">Add</a> 
  <br>
        
          
          <table class="table table-bordered" id="laravel_crud">
           <thead>
              <tr>
                 <th>Id</th>
                 <th>Tool</th>
                 <th>Created at</th>
                 <td colspan="2">Action</td>
              </tr>
           </thead>
           <tbody>
              @foreach($VacancyTools as $VacancyTool)
              <tr>
                 <td>{{ $VacancyTool->id }}</td>
                 <td>{{ $VacancyTool->vacancy_tool }}</td>
                 <td>{{ date('Y-m-d', strtotime($VacancyTool->created_at)) }}</td>
                 <td><a href="{{ route('backend.work.tool.edit',$VacancyTool->id)}}" class="btn btn-primary">Edit</a></td>
                 <td>
                 <form action="{{ route('backend.work.tool.destroy', $VacancyTool->id)}}" method="post">
                  {{ csrf_field() }}
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                </td>
              </tr>
              @endforeach
           </tbody>
          </table>
          {!! $VacancyTools->links() !!}
       </div> 
   </div>
 @endsection  
