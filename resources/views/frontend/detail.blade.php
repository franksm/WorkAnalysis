@extends('frontend.layouts.master')
@section('nav_detail', 'active')
@section('content')
    <div class="col-md-12">
        <table class="table">
                <thead>
                    <tr>
                    <th>需求工作經驗</th>
                    <th>出現數量</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($claimExperiences as $claimExperience=>$claimExperienceQuantity)
                        <tr>
                            <th>{{$claimExperience}}</th>
                            <th>{{$claimExperienceQuantity}}</th>
                        </tr>
                        @endforeach
                </tbody>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                <th>需求學歷</th>
                <th>出現數量</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($claimEducations as $claimEducation=>$claimEducationQuantity)
                    <tr>
                        <th>{{$claimEducation}}</th>
                        <th>{{$claimEducationQuantity}}</th>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
                        <tr>
                        <th>職務種類</th>
                        <th>出現數量</th>
                        </tr>
            </thead>
            <tbody>
                            @foreach ($categories as $category=>$categoryQuantity)
                            <tr>
                                <th>{{$category}}</th>
                                <th>{{$categoryQuantity}}</th>
                            </tr>
                            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>需求工具種類</th>
                    <th>出現數量</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tools as $tool=>$toolQuantity)
                <tr>
                    <th>{{$tool}}</th>
                    <th>{{$toolQuantity}}</th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection