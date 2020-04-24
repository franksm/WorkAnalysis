@extends('layouts.app')
@section('header_title', 'Edit Interest')
@section('content')

<br>
 
<form action="{{ route('backend.work.tool.update', $VacancyTools->id) }}" method="POST" name="update_tool">
{{ csrf_field() }}
@method('PATCH')
 
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong>職缺擅長工具</strong>
            <input type="text" name="vacancy_tool" class="form-control" placeholder="Enter Tool" value="{{ $VacancyTools->vacancy_tool }}">
            <span class="text-danger">{{ $errors->first('vacancy_tool') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
 
</form>
@endsection
