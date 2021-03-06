@extends('layouts.app')
@section('title', '會員系統')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">訊息</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    你已登入
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
