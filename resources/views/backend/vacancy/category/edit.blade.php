@extends('layouts.app')
@section('header_title', 'Edit Category')
@section('content')

<br>
 
<form action="{{ route('backend.work.category.update', $VacancyCategories->id) }}" method="POST" name="update_category">
{{ csrf_field() }}
@method('PATCH')
 
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong>職缺種類</strong>
            <input type="text" name="vacancy_category" class="form-control" placeholder="Enter Category" value="{{ $VacancyCategories->vacancy_category }}">
            <span class="text-danger">{{ $errors->first('vacancy_category') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
 
</form>
@endsection
