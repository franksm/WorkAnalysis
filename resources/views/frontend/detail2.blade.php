@extends('frontend.layouts.master')
@section('nav_detail', 'active')
@section('content')
<div class="tag">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                    <th>需求工作經驗</th>
                    <th>出現數量</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                        @foreach ($claimExperiences as $claimExperience=>$claimExperienceQuantity)
                        <tr>
                            @if ($claimExperience=='total')
                                <th>{{$claimExperience}}</th>
                                <th>全部共有:{{$claimExperienceQuantity}}筆</th>
                            @else
                                <th>{{$claimExperience}}</th>
                                <th>{{$claimExperienceQuantity}}</th>
                            @endif
                        </tr>
                        @endforeach
                    
                </tbody>
        </div>
    </div>
</div>
@endsection