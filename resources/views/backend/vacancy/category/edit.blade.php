@extends('layouts.app')
@section('header_title', 'Edit Category')
@section('content')

<br>
<div class="container">
<div class="col-12">
<form action="{{ route('backend.work.category.update', $VacancyCategorys->id) }}" method="POST" name="update_category">
{{ csrf_field() }}
@method('PATCH')
 

        <div class="form-group">
            <strong>職缺種類</strong>
            <input type="text" name="vacancy_category" class="form-control" placeholder="Enter Category" value="{{ $VacancyCategorys->vacancy_category }}">
            <span class="text-danger">{{ $errors->first('vacancy_category') }}</span>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
 
</form>
@endsection
