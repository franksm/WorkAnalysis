@extends('user.savework.analysis.layouts.master')
@section('nav_suitable', 'active')
@section('content')
<link rel="stylesheet" href="https://www.104.com.tw/jobs/apply/static/css/app.min.css?id=7bc7c107a1569c7cfad5">
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var suitableChart = document.getElementById('suitableChart').getContext('2d');
        var vacancy ={!!json_encode($value);!!};
        vacancy = Object.keys(vacancy);
        var category ={!!json_encode(array_column($value,'category'));!!};
        var tool ={!!json_encode(array_column($value,'tool'));!!};
        var claim_education ={!!json_encode(array_column($value,'claim_education'));!!};
        var claim_experience ={!!json_encode(array_column($value,'claim_experience'));!!};
        var score ={!!json_encode(array_column($value,'score'));!!};
        $.each(vacancy, function(index, name){
            var i = 0;
            vacancy[index] = [];
            while (name.length > 0) {
                vacancy[index][i] = name.substring(0, 4); 
                name = name.substring(4); 
                i++;
            }
        });
        
        var suitable = new Chart(suitableChart, {
            type: 'bar',
            data: {
                labels: vacancy,
                datasets: [{
                    label: '希望職缺',
                    type:'bar',
                    data: category,
                    backgroundColor: 'rgba(212, 33, 32, 0.2)',
                    borderColor: 'rgba(212, 33, 32, 1)',
                    borderWidth: 1,
                },{
                    label: '擅長工具',
                    data: tool,
                    type:'bar',
                    backgroundColor: 'rgba(12, 33, 64, 0.2)',
                    borderColor: 'rgba(12, 33, 64, 1)',
                    borderWidth: 1,
                },{
                    label: '教育程度',
                    data: claim_education,
                    type:'bar',
                    backgroundColor: 'rgba(54, 99, 96, 0.2)',
                    borderColor: 'rgba(54, 99, 96, 1)',
                    borderWidth: 1,
                },
                {
                    label: '工作經歷',
                    data: claim_experience,
                    type:'bar',
                    backgroundColor: 'rgba(123, 44, 128, 0.2)',
                    borderColor: 'rgba(123, 44, 128, 1)',
                    borderWidth: 1,
                },{
                    label: '綜合評分',
                    data: score,
                    type:'bar',
                    backgroundColor: 'rgba(45,22, 128, 0.2)',
                    borderColor: 'rgba(45, 22, 128, 1)',
                    borderWidth: 1,
                },
                ]
            },
            options: {
                scales: { 
                    yAxes: [{
                        id: 'y-axis-1', 
                        position:'left',
                        ticks: {min: 0,max: 100},
                        scaleLabel: {
                            display: true,
                            labelString: '分數'
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
            }
        });
    });
</script>

<div class="m-lg-4 ">
    <div id='link' style="float:right;">
        <a class="nav-link" href="/analysis/suitable">使用Pearson</a>
        <a class="nav-link" href="/analysis/suitable?type=noPearson">不使用Pearson</a>   
    </div>
    <div class="bar_analysis">
       <dd><canvas id="suitableChart" width="1200" height="600"></canvas></dd>
    </div>
</div>
@endsection