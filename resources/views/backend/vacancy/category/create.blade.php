@extends('layouts.app')
@section('header_title', 'Add Category')
@section('content')

<br>
 
<form action="{{ route('backend.work.category.store') }}" method="POST" name="add_category">
{{ csrf_field() }}
 
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong>職缺擅長工具</strong>
            <input type="text" name="vacancy_category" class="form-control" placeholder="Enter Category">
            <span class="text-danger">{{ $errors->first('vacancy_category') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
 
</form>
@endsection
