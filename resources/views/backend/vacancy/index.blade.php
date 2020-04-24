@extends('layouts.app')
@section('title', 'Vacancy')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <input type="button" value="新增種類列表" onclick="location.href='category/'">
                    <input type="button" value="新增工具列表" onclick="location.href='tool/'">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection