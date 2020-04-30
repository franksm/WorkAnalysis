
@extends('frontend.layouts.master')
@section('nav_list', 'active')
@section('content')
<style type="text/css">
        p{
            white-space: pre-line;
        }
</style>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>職缺名稱</th>
                                {{-- <th>公司名稱</th> --}}
                                <th>職缺類別</th>
                                <th>需求工具</th>
                                <th>薪資類型</th>
                                <th>薪資</th>
                                <th>工作性質</th>
                                <th>需求學歷</th>
                                <th>工作經歷</th>
                                <th>需求人數</th>
                                <th>是否出差外派</th>
                                <th>本職缺連結</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Vacancies as $Vacancy)
                            <tr>
                                <th>{{$Vacancy->vacancy_name}}</th>
                                {{-- <th>{{$Companies[$Vacancy->id]['company_name']}}</th> --}}
                                <th>
                                    @foreach ($Categories[$Vacancy->id] as $Category)
                                        {{$Category['vacancy_category']}},
                                    @endforeach
                                </th>
                                <th>
                                    @foreach ($Tools[$Vacancy->id] as $Tool)
                                        {{$Tool['vacancy_tool']}},
                                    @endforeach
                                </th>
                                <th>{{$Vacancy->salary_category}}</th>
                                <th>{{$Vacancy->salary}}</th>
                                <th>{{$Vacancy->work_nature}}</th>
                                <th>{{$Vacancy->claim_education}}</th>
                                <th>{{$Vacancy->claim_experience}}</th>
                                <th>{{$Vacancy->claim_people}}</th>
                                <th>{{$Vacancy->expatriate}}</th>
                                <th><a href="{{$Vacancy->link}}">導引至頁面</a></th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>公司名稱</th>
                                    <th>職缺名稱</th>
                                    <th>產業類別</th>
                                    <th>資本額</th>
                                    <th>員工數</th>
                                    <th>公司地點</th>
                                    <th>公司連結</th>
                                    <th>公司福利</th>
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
                                    <th><a href="{{$Company['link']}}">公司連結</a></th>
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
                                        <div class="text-center">
                                            <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#a{{$Company['id']}}">公司福利</a>
                                        </div>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>    
                </div>
@endsection

