@extends('layouts.app')
@section('title', '履歷資料')
@section('content')
<div class="m-lg-4">
    <a href="{{ route('user.resume.edit',$UserId) }}" class="btn btn-primary mb-lg-1">修改履歷</a> 

    <table class="table table-bordered table-info" style="line-height:40px;">
        <tr>
            <td>姓名</td>
            <td>{{$Resume->name}}</td>
            <td>年齡</td>
            <td>{{$Resume->age}}</td>
            <td>出生</td>
            <td>{{$Resume->born}}</td>
        </tr>
        <tr>
            <td>學歷</td>
            <td colspan="2">{{$Resume->education}}</td>
            <td>工作經歷</td>
            <td colspan="2">{{$Resume->experience}}</td>
        </tr>
        <tr>
            <td>希望職類</td>
            <td colspan="2">{{$Categories}}</td>
            <td>擅長工具</td>
            <td colspan="2">{{$Tools}}</td>
        </tr>
    </table>
    

@endsection