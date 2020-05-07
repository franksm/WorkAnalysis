
@extends('user.savework.analysis.layouts.master')
@section('nav_list', 'active')
@section('content')
<style type="text/css">
        p{
            white-space: pre-line;
        }
</style>
<div class="m-lg-4">
                    <h3>職缺綜合資訊</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
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
                            @foreach ($sortVacancy as $key=>$sortVacancyItem)
                            <tr>
                                @if($Vacancies[$key]["score"]>=0.7)
                                    <th><img src="/image/B89pLVWn3M.png" width="20" height="20"></th>
                                @else
                                    
                                @endif
                                <th><th>
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
                                <th>{{$Vacancies[$key]['claim_education']}}</th>
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

