
@extends('user.savework.analysis.layouts.master')
@section('nav_list', 'active')
@section('content')
<style type="text/css">
        p{
            white-space: pre-line;
        }
</style>
<script language="JavaScript">
    
    function compareResumes()
    {
        var resume = {!! json_encode($resume) !!}
        var resumeTools = {!! json_encode($resumeTools) !!}

        var table = document.getElementById('vacancy');
        var education = {'不拘':0,'高中':1,'專科':2,'大學':3,'碩士':4,'博士':5};
        var experiences = {'不拘':0,'1年':1,'2年':2,'3年':3,'4年':4,'5年':5,'6年':6,'7年':7,'8年':8,'9年':9,'10年':10};
        for (var row = 1; row < table.rows.length; row++) {
            if(education[table.rows[row].cells[6].innerHTML]>=education[resume['education']]){
                table.rows[row].cells[6].innerHTML = "<img src={{url('/image/meet.png')}} width=30 heigth=30>";
            }else{
                table.rows[row].cells[6].innerHTML = "<img src={{url('/image/notmeet.png')}} width=30 heigth=30>";
            }
            if(experiences[table.rows[row].cells[7].innerHTML]>=experiences[resume['experience']]){
                table.rows[row].cells[7].innerHTML = "<img src={{url('/image/meet.png')}} width=30 heigth=30>";
            }else{
                table.rows[row].cells[7].innerHTML = "<img src={{url('/image/notmeet.png')}} width=30 heigth=30>";
            }
            var Tools = table.rows[row].cells[2].innerText.replace(/\r\n|\n|\s+/g, "");
            console.log(Tools);
            if(Tools!='不拘,'){
                Tools = Tools.split(",");
                var ToolSame = "";
                var ToolDiff = ""; 
                Tools.forEach((item,index)=>{
                    if(resumeTools.indexOf(item)!=-1){
                        ToolSame += item+',';
                    }else{
                        ToolDiff += item+',';
                    }
                });
                ToolSame = ToolSame.substring(0, ToolSame.length-1);
                ToolDiff = ToolDiff.substring(0, ToolDiff.length-2);
                table.rows[row].cells[2].innerHTML = "<img src={{url('/image/meet.png')}} width=20 heigth=20>："+ToolSame+"<br/><img src={{url('/image/notmeet.png')}} width=20 heigth=20>："+ToolDiff;
            }
        }
        var currentBtn = document.getElementById('result');
        currentBtn.style.display = "none";
        var currentBtn = document.getElementById('init');
        currentBtn.style.display = "block";
    }
    function tableInit()
    {
        var table=document.getElementById('vacancy');
        table.reload();
    }

</script>
<div class="m-lg-4">
                    <div style="float:right;">
                        <button id='init' class="btn-primary my-lg-1" onclick="javascript:window.location.reload()" style='display:none'>原始表單</button>
                        <button id='result' class="btn-primary my-lg-1" onclick="compareResumes(this)">比對履歷1</button>
                    </div>
                    <h3>職缺綜合資訊</h3>
                    <table id="vacancy" class="table">
                        <thead>
                            <tr>
                                <th>職缺名稱</th>
                                <th>職缺類別</th>
                                <th>需求工具</th>
                                <th>薪資類型</th>
                                <th>薪資</th>
                                <th>工作性質</th>
                                <th>需求學歷</th>
                                <th>工作經歷</th>
                                <th>需求人數</th>
                                <th>是否出差外派</th>
                                <th>職缺連結</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($score as $key=>$scoreItem)
                            <tr>
                                <th>{{$Vacancies[$key]['vacancy_name']}}</th>
                                <th>
                                    @foreach ($Categories[$Vacancies[$key]['id']] as $Category)
                                        {{$Category['vacancy_category']}},
                                    @endforeach
                                </th>
                                <th>
                                    @foreach ($Tools[$Vacancies[$key]['id']] as $Tool)
                                        {{$Tool['vacancy_tool']}},
                                    @endforeach
                                </th>
                                <th>{{$Vacancies[$key]['salary_category']}}</th>
                                <th>{{$Vacancies[$key]['salary']}}</th>
                                <th>{{$Vacancies[$key]['work_nature']}}</th>
                                <th id='education'>{{$Vacancies[$key]['claim_education']}}</th>
                                <th>{{$Vacancies[$key]['claim_experience']}}</th>
                                <th>{{$Vacancies[$key]['claim_people']}}</th>
                                <th>{{$Vacancies[$key]['expatriate']}}</th>
                                <th><a href="{{$Vacancies[$key]['link']}}">職缺連結</a></th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h3>公司綜合資訊</h3>
                    <table class="table">
                            <thead>
                                <tr>
                                    <th>公司名稱</th>
                                    <th>職缺名稱</th>
                                    <th>產業類別</th>
                                    <th>資本額</th>
                                    <th>員工數</th>
                                    <th>公司地點</th>
                                    <th>公司福利</th>
                                    <th>公司連結</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Companies as $Company)
                                <tr>
                                    <th>{{$Company['company_name']}}</th>
                                    <th>
                                        @foreach ($Company['vacancy'] as $companyVacancyName)
                                            {{$companyVacancyName['vacancy_name']}},
                                        @endforeach
                                    </th>
                                    <th>{{$Company['industry_category']}}</th>
                                    <th>{{$Company['capital']}}</th>
                                    <th>{{$Company['workers']}}</th>
                                    <th>{{$Company['region'].$Company['area']}}</th>
                                        <div class="modal fade" id="a{{$Company['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">
                                                        <h4 class="modal-title w-100 font-weight-bold">公司福利</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <p>{{$Company['welfare']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <th>
                                        <div>
                                            <a href="" data-toggle="modal" data-target="#a{{$Company['id']}}">公司福利</a>
                                        </div>
                                    </th>
                                    <th><a href="{{$Company['link']}}">公司連結</a></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
@endsection

