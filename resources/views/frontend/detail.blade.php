@extends('frontend.layouts.master')
@section('nav_detail', 'active')
@section('content')
<link rel="stylesheet" href="https://www.104.com.tw/jobs/apply/static/css/app.min.css?id=7bc7c107a1569c7cfad5">

<div class="col-md-12">

<div class="content_full analysis-section">
    <h1>職缺比一比</h1>
    <hr size="64px" width="100%">
    <section id="analysisSection" class="rpt_box">  
                <div class="bar-row">
                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>工作經驗</h3>
                        </div>
                        <div class="box_analysis" id="box_experience">
                            @foreach ($claimExperiences as $claimExperience=>$claimExperienceQuantity)
                                <dl>
                                    <dt title="{{$claimExperience}}">{{$claimExperience}}</dt>
                                    <dd class="bar"><div style="width: {{$claimExperienceQuantity}}%;"></div></dd>
                                    <dd class="ratio">{{$claimExperienceQuantity}}%</dd>
                                </dl>
                            @endforeach
                        </div>
                    </div>

                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>學歷分佈</h3>
                        </div>
                        <div class="box_analysis" id="box_education">
                            @foreach ($claimEducations as $claimEducation=>$claimEducationQuantity)
                                <dl>
                                    <dt title="{{$claimEducation}}">{{$claimEducation}}</dt>
                                    <dd class="bar"><div style="width: {{$claimEducationQuantity}}%;"></div></dd>
                                    <dd class="ratio">{{$claimEducationQuantity}}%</dd>
                                </dl>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="bar-row">
                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>職務種類</h3>
                        </div>
                        <div class="box_analysis" id="box_category">
                            @foreach ($categories as $category=>$categoryQuantity)
                                <dl>
                                    <dt title="{{$category}}">{{$category}}</dt>
                                    <dd class="bar"><div style="width: {{$categoryQuantity}}%;"></div></dd>
                                    <dd class="ratio">{{$categoryQuantity}}%</dd>
                                </dl>
                            @endforeach
                        </div>
                    </div>

                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>工具種類</h3>
                        </div>
                        <div class="box_analysis" id="box_tool">
                            @foreach ($tools as $tool=>$toolQuantity)
                                <dl>
                                    <dt title="{{$tool}}">{{$tool}}</dt>
                                    <dd class="bar"><div style="width: {{$toolQuantity}}%;"></div></dd>
                                    <dd class="ratio">{{$toolQuantity}}%</dd>
                                </dl>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr size="64px" width="100%">
                <h1>企業比一比</h1>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>產業類別</th>
                            <th>出現數量</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($industryCategories as $industryCategory=>$industryCategoryQuantity)
                                <tr>
                                <th>{{$industryCategory}}</th>
                                <th>{{$industryCategoryQuantity}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                </div>
    </section>
</div>
</div>
@endsection