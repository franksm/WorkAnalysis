@extends('user.savework.analysis.layouts.master')
@section('nav_suitable', 'active')
@section('content')
<link rel="stylesheet" href="https://www.104.com.tw/jobs/apply/static/css/app.min.css?id=7bc7c107a1569c7cfad5">
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var suitableChart = document.getElementById('suitableChart').getContext('2d');
        var company = ['A公司','B公司','C公司'];
        var suitable = new Chart(suitableChart, {
            type: 'bar',
            data: {
                labels: company,
                datasets: [{
                    label: '比較1',
                    type:'bar',
                    data: [10,20,30],
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                },{
                    label: '比較2',
                    data: [30,20,10],
                    type:'bar',
                    backgroundColor: 'rgba(33, 122, 64, 0.2)',
                    borderColor: 'rgba(33, 122, 64, 1)',
                    borderWidth: 1,
                },
                {
                    label: '比較3',
                    data: [13,21,17],
                    type:'bar',
                    backgroundColor: 'rgba(99, 33, 22, 0.2)',
                    borderColor: 'rgba(99, 33, 22, 1)',
                    borderWidth: 1,
                },
                {
                    label: '比較4',
                    data: [22,12,1],
                    type:'bar',
                    backgroundColor: 'rgba(255, 66, 64, 0.2)',
                    borderColor: 'rgba(255, 66, 64, 1)',
                    borderWidth: 1,
                },
                {
                    label: '綜合',
                    data: [44,23,11],
                    type:'bar',
                    backgroundColor: 'rgba(33, 44, 122, 0.2)',
                    borderColor: 'rgba(33, 44, 122, 1)',
                    borderWidth: 1,
                }]
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
    <div class="bar_analysis">
       <dd><canvas id="suitableChart" width="1200" height="600"></canvas></dd>
    </div>
</div>
@endsection