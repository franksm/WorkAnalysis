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
                                    <dt>
                                        <a href="" data-toggle="modal" data-target="#a{{$claimExperience}}">{{$claimExperience}}</a>
                                    </dt>
                                    <dd class="bar"><div style="width: {{$claimExperienceQuantity['percentage']}}%;"></div></dd>
                                    <dd class="ratio">{{$claimExperienceQuantity['percentage']}}%</dd>
                                    <div class="modal fade" id="a{{$claimExperience}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h4 class="modal-title w-100 font-weight-bold">工作經驗資訊</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div>
                                                    <hr>
                                                    @foreach ($claimExperienceQuantity['vacancy'] as $item)
                                                        <a href={{$item['vacancy_link']}}>{{$item['vacancy_name']}}</a>
                                                        <a href={{$item['company_link']}}>{{$item['company_name']}}</a>
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <dt>
                                        <a href="" data-toggle="modal" data-target="#a{{$claimEducation}}">{{$claimEducation}}</a>
                                    </dt>
                                    <dd class="bar"><div style="width: {{$claimEducationQuantity['percentage']}}%;"></div></dd>
                                    <dd class="ratio">{{$claimEducationQuantity['percentage']}}%</dd>
                                    <div class="modal fade" id="a{{$claimEducation}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h4 class="modal-title w-100 font-weight-bold">學歷資訊</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div>
                                                    <hr>
                                                    @foreach ($claimEducationQuantity['vacancy'] as $item)
                                                        <a href={{$item['vacancy_link']}}>{{$item['vacancy_name']}}</a>
                                                        <a href={{$item['company_link']}}>{{$item['company_name']}}</a>
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <dt>
                                        <a href="" data-toggle="modal" data-target="#a{{$category}}">{{$category}}</a>
                                    </dt>
                                    <dd class="bar"><div style="width: {{$categoryQuantity['percentage']}}%;"></div></dd>
                                    <dd class="ratio">{{$categoryQuantity['percentage']}}%</dd>
                                    <div class="modal fade" id="a{{$category}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h4 class="modal-title w-100 font-weight-bold">職務種類資訊</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div>
                                                    <hr>
                                                    @foreach ($categoryQuantity['vacancy'] as $item)
                                                        <a href={{$item['vacancy_link']}}>{{$item['vacancy_name']}}</a>
                                                        <a href={{$item['company_link']}}>{{$item['company_name']}}</a>
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </dl>
                            @endforeach
                        </div>
                    </div>
                    
                <th>
                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>工具種類</h3>
                        </div>
                        <div class="box_analysis" id="box_tool">
                            @foreach ($tools as $tool=>$toolQuantity)
                                <dl>
                                    <dt>
                                        <a href="" data-toggle="modal" data-target="#a{{$tool}}">{{$tool}}</a>
                                    </dt>
                                    <dd class="bar"><div style="width: {{$toolQuantity['percentage']}}%;"></div></dd>
                                    <dd class="ratio">{{$toolQuantity['percentage']}}%</dd>
                                    <div class="modal fade" id="a{{$tool}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h4 class="modal-title w-100 font-weight-bold">職務種類資訊</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div>
                                                    <hr>
                                                    @foreach ($toolQuantity['vacancy'] as $item)
                                                        <a href={{$item['vacancy_link']}}>{{$item['vacancy_name']}}</a>
                                                        <a href={{$item['company_link']}}>{{$item['company_name']}}</a>
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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