@extends('layouts.app')
@section('header_title', 'Edit Interest')
@section('content')

<br>
<div class="container">
<div class="col-12">
<form action="{{ route('backend.work.tool.update', $VacancyTools->id) }}" method="POST" name="update_tool">
{{ csrf_field() }}
@method('PATCH')
 
        <div class="form-group">
            <strong>職缺擅長工具</strong>
            <input type="text" name="vacancy_tool" class="form-control" placeholder="Enter Tool" value="{{ $VacancyTools->vacancy_tool }}">
            <span class="text-danger">{{ $errors->first('vacancy_tool') }}</span>
        </div>
    
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
 
</form>
@endsection
