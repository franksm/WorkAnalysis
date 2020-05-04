@extends('frontend.layouts.master')
@section('nav_detail', 'active')
@section('content')
<link rel="stylesheet" href="https://www.104.com.tw/jobs/apply/static/css/app.min.css?id=7bc7c107a1569c7cfad5">
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            }
        });
    });
</script>


<div class="col-md-12">
<div class="content_full analysis-section">
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
                <div class="bar-row">
                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>產業類別</h3>
                        </div>
                        <div class="box_analysis" id="box_category">
                            @foreach ($industryCategories as $industryCategory=>$industryCategoryQuantity)
                                <dl>
                                    <dt title="{{$industryCategory}}">{{$industryCategory}}</dt>
                                    <dd class="bar"><div style="width: {{$industryCategoryQuantity}}%;"></div></dd>
                                    <dd class="ratio">{{$industryCategoryQuantity}}%</dd>
                                </dl>
                            @endforeach
                        </div>
                    </div>
                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>測試</h3>
                        </div>
                        <div class="box_analysis" id="box_test">
                            <dl>
                                <dd><canvas id="chart" width="600" height="200"></canvas></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                
    </section>
</div>
</div>
@endsection