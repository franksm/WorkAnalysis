@extends('layouts.app')
@section('title', '履歷資料')
@section('content')
<div class="m-lg-4">
@if ($Resume == 'null')
<a href="{{ route('user.resume.create') }}" class="btn btn-success mb-2">添加履歷</a> 
@else
<a href="{{ route('user.resume.edit',$UserId) }}" class="btn btn-success mb-2">修改履歷</a> 
@endif
</div>
@endsection