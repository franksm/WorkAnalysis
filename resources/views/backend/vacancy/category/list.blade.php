@extends('layouts.app')
@section('header_title', 'Category List')
@section('content')
  <a href="{{ route('backend.work.category.create') }}" class="btn btn-success mb-2">Add</a> 
  <br>
   <div class="row">
        <div class="col-12">
          
          <table class="table table-bordered" id="laravel_crud">
           <thead>
              <tr>
                 <th>Id</th>
                 <th>Category</th>
                 <th>Created at</th>
                 <td colspan="2">Action</td>
              </tr>
           </thead>
           <tbody>
              @foreach($VacancyCategories as $VacancyCategory)
              <tr>
                 <td>{{ $VacancyCategory->id }}</td>
                 <td>{{ $VacancyCategory->vacancy_category }}</td>
                 <td>{{ date('Y-m-d', strtotime($VacancyCategory->created_at)) }}</td>
                 <td><a href="{{ route('backend.work.category.edit',$VacancyCategory->id)}}" class="btn btn-primary">Edit</a></td>
                 <td>
                 <form action="{{ route('backend.work.category.destroy', $VacancyCategory->id)}}" method="post">
                  {{ csrf_field() }}
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                </td>
              </tr>
              @endforeach
           </tbody>
          </table>
          {!! $VacancyCategories->links() !!}
       </div> 
   </div>
 @endsection  
