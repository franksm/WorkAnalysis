@extends('layouts.app')
@section('title', 'Add Category')
@section('content')

<br>
<div class="container">
<div class="col-12">
<form action="{{ route('backend.work.category.store') }}" method="POST" name="add_category">
{{ csrf_field() }}
 

        <div class="form-group">
            <strong>職缺種類</strong>
            <input type="text" name="vacancy_category" class="form-control" placeholder="Enter Category">
            <span class="text-danger">{{ $errors->first('vacancy_category') }}</span>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
 
</form>
@endsection
