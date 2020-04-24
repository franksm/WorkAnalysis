@extends('layouts.app')
@section('header_title', 'Add Tool')
@section('content')

<br>
<div class="container">
<div class="col-12">

<form action="{{ route('backend.work.tool.store') }}" method="POST" name="add_tool">
{{ csrf_field() }}
 
        <div class="form-group">
            <strong>職缺擅長工具</strong>
            <input type="text" name="vacancy_tool" class="form-control" placeholder="Enter Tool">
            <span class="text-danger">{{ $errors->first('vacancy_tool') }}</span>
        </div>
    
    
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
</div>
 
</form>
@endsection
