@extends('layouts.app')
@section('title', '履歷資料')
@section('content')
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.selectTool').select2({placeholder: "Select Tool"});
        $('.selectCategory').select2({placeholder: "Select Category"});
    });
</script>

<div class="m-lg-4">
<form action="{{ route('user.resume.store') }}" method="POST" name="add_resume">
{{ csrf_field() }}
 
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong>姓名</strong>
            <input type="text" name="name" class="form-control" placeholder="Enter Name">
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <strong>年齡</strong>
            <input type="text" name="age" class="form-control" placeholder="Enter Age">
            <span class="text-danger">{{ $errors->first('age') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <strong>出生日期</strong>
            <input type="text" name="born" class="form-control" placeholder="Enter Born">
            <span class="text-danger">{{ $errors->first('born') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <strong>學歷</strong><br>
        <select class="selectEduction" style="width:100%;" name="education"  required lay-verify="required">
            <option value="" style="display:none" >請選擇學歷</option>
            <option value="高中">高中</option>
            <option value="專科">專科</option>
            <option value="大學">大學</option>
            <option value="碩士">碩士</option>
            <option value="博士">博士</option>
        </select>
    </div>
    <div class="col-md-12">
        <strong>工作經歷</strong><br>
        <select class="selectExperience" style="width:100%;" name="experience"  required lay-verify="required">
            <option value="" style="display:none" >請選擇工作經歷</option>
            <option value="無經歷">無經歷</option>
            <option value="1年">一年</option>
            <option value="2年">兩年</option>
            <option value="3年">三年</option>
            <option value="4年">四年</option>
            <option value="5年">五年</option>
            <option value="6年">六年</option>
            <option value="7年">七年</option>
            <option value="8年">八年</option>
            <option value="9年">九年</option>
            <option value="10年">十年</option>
        </select>
    </div>
    <div class="col-md-12">
        <strong>希望職類</strong><br>
        <select class="selectCategory" style="width:100%;" name="categories[]" multiple="multiple" required>
            @foreach ($CategoryAll as $Category)
                <option value='{{ $Category->id }}'>{{$Category->vacancy_category}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12">
        <strong>擅長工具</strong><br>
        <select class="selectTool" style="width:100%;" name="tools[]" multiple="multiple" required>
            @foreach ($ToolAll as $Tool)
                @if ($Tool->vacancy_tool != '不拘')
                <option value='{{ $Tool->id }}'>{{$Tool->vacancy_tool}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <br>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">送出表單</button>
    </div>
</div>
 
</form>
</div>
@endsection