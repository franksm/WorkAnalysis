@extends('layouts.app')
@section('title', 'Vacancy List')
@section('content')
<div class="container">
<div class="col-12">
  <a href="{{ route('backend.work.vacancy.create') }}" class="btn btn-success mb-2">Add</a> 
  <br>      
          <table class="table table-bordered" id="laravel_crud">
           <thead>
              <tr>
                 <th>Id</th>
                 <th>職缺名稱</th>
                 <th>公司名稱</th>
                 <th>工作經歷</th>
                 <th>學歷</th>
                 <th>縣市</th>
                 <th>縣市區段</th>
                 <th>創建時間</th>
                 <td colspan="2">修改與刪除</td>
              </tr>
           </thead>
           <tbody>
              @foreach($Vacancies as $Vacancy)
              <tr>
                 <td>{{ $Vacancy->id }}</td>
                 <td>{{ $Vacancy->vacancy_name }}</td>
                 <td>{{ $Vacancy->company_name }}</td>
                 <td>{{ $Vacancy->claim_education }}</td>
                 <td>{{ $Vacancy->claim_experience }}</td>
                 <td>{{ $Vacancy->region }}</td>
                 <td>{{ $Vacancy->area }}</td>
                 <td>{{ date('Y-m-d', strtotime($Vacancy->created_at)) }}</td>
                 <td><a href="{{ route('backend.work.vacancy.edit',$Vacancy->id)}}" class="btn btn-primary">修改</a></td>
                 <td>
                 <form action="{{ route('backend.work.vacancy.destroy', $Vacancy->id)}}" method="post">
                  {{ csrf_field() }}
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">刪除</button>
                </form>
                </td>
              </tr>
              @endforeach
           </tbody>
          </table>
          {!! $Vacancies->links() !!}
       </div> 
   </div>
 @endsection  
