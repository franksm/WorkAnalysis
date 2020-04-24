@extends('layouts.layout')
@section('header_title', 'Edit People')
@section('content')

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.selectInterest').select2({placeholder: "Select Interest"});
        var interests_info = {!! json_encode($interests_info); !!};
        $(".selectInterest").val(interests_info).trigger("change");
    });
</script>

<br>
 
<form action="{{ route('people.update', $people_info->id) }}" method="POST" name="update_people">
{{ csrf_field() }}
@method('PATCH')
 
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong>Name</strong>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $people_info->name }}">
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <strong>Age</strong>
            <input type="text" name="age" class="form-control" placeholder="Enter Age" value="{{ $people_info->age }}">
            <span class="text-danger">{{ $errors->first('age') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <strong>Born</strong>
            <input type="text" name="born" class="form-control" placeholder="Enter Born" value="{{ $people_info->born }}">
            <span class="text-danger">{{ $errors->first('born') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <strong>Interest</strong><br>
        <select class="selectInterest" style="width:100%;" name="interests[]" multiple="multiple" required>
            @foreach ($interests as $interest)
                <option value='{{ $interest->id }}'>{{$interest->interest}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
 
</form>
@endsection
