@extends('frontend.layouts.master')
@section('nav_detail', 'active')
@section('content')
<link rel="stylesheet" href="https://www.104.com.tw/jobs/apply/static/css/app.min.css?id=7bc7c107a1569c7cfad5">
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var workChart = document.getElementById('workerChart').getContext('2d');
        var worker ={!!json_encode($workers);!!};
        var capital = {!!json_encode($capitals);!!};
        var workerchart = new Chart(workChart, {
            type: 'bar',
            data: {
                labels: Object.keys(worker),
                datasets: [{
                    label: '員工人數',
                    type:'bar',
                    data: Object.values(worker),
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                    
                },{
                    label: '資本額',
                    data: Object.values(capital),
                    type:'line',
                    backgroundColor: 'rgba(255, 255, 255, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                }]
            },
            options: { 
                scales: { 
                    yAxes: [{
                    id: 'y-axis-1', 
                    ticks: {min: 0},
                    scaleLabel: {
                            display: true,
                            labelString: '資本額(萬)'
                        }
                    }],
                    xAxes: [{
                    id: 'x-axis-1', 
                    scaleLabel: {
                            display: true,
                            labelString: '公司名稱'
                        }
                    }] 
                },
                hover: {
                    animationDuration: 0 // 防止鼠标移上去，数字闪烁
                },
                animation: { // 这部分是数值显示的功能实现
                    onComplete: function () {
                        var chartInstance = this.chart,
                
                        ctx = chartInstance.ctx;
                        // 以下属于canvas的属性（font、fillStyle、textAlign...）
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.fillStyle = "black";
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';
                        
                        var dataset = this.data.datasets[0];
                        console.log(dataset);
                        var meta = chartInstance.controller.getDatasetMeta(0);
                        meta.data.forEach(function (bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                    }
                }
            },
        });
    });
</script>


<div class="m-lg-4">
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
                                                    <h4 class="modal-title w-100 font-weight-bold">工具種類資訊</h4>
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
                <h1>企業比一比</h1>
                <hr size="64px" width="100%">
                <div class="bar-row">
                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>產業類別</h3>
                        </div>
                        <div class="box_analysis" id="box_category">
                            @foreach ($industryCategories as $industryCategory=>$industryCategoryQuantity)
                                <dl>
                                    <dt>
                                        <a href="" data-toggle="modal" data-target="#a{{$industryCategory}}">{{$industryCategory}}</a>
                                    </dt>
                                    <dd class="bar"><div style="width: {{$industryCategoryQuantity['percentage']}}%;"></div></dd>
                                    <dd class="ratio">{{$industryCategoryQuantity['percentage']}}%</dd>
                                    <div class="modal fade" id="a{{$industryCategory}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h4 class="modal-title w-100 font-weight-bold">產業類別資訊</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div>
                                                    <hr>
                                                    @foreach ($industryCategoryQuantity['company'] as $item)
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
                            <h3>員工人數</h3>
                        </div>
                        <div  height="600" id="box_test">
                            <dl>
                                <dd><canvas id="workerChart" width="1200" height="600"></canvas></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                
    </section>
</div>
</div>
@endsection