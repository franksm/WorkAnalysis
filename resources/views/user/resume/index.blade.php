@extends('layouts.app')
@section('title', '履歷資料')
@section('content')
<div class="m-lg-4">
@if ($Resume == null)
<a href="{{ route('user.resume.create') }}" class="btn btn-primary">添加履歷</a> 
@else
<a href="{{ route('user.resume.show',$UserId) }}" class="btn btn-primary">顯示履歷</a> 
@endif
</div>
@endsection