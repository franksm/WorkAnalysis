<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <form action="{{ route('backend.work.web.update'),}}" method="post">
    <div class="tag">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
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
                                <th>是否附管理責任</th>
                                <th>是否出差外派</th>
                                <th>本職缺連結</th>
                                <th>公司福利</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Vacancies as $Vacancy)
                            <tr>
                                <th>{{$Vacancy->vacancy_name}}</th>
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
                                <th>{{$Vacancy->management_responsibility}}</th>
                                <th>{{$Vacancy->expatriate}}</th>
                                <th><a href="{{$Vacancy->link}}">導引至頁面</a></th>
                                <th>
                                    <div class="modal fade" id="a{{$Vacancy->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h4 class="modal-title w-100 font-weight-bold">公司福利</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div>
                                                    {{$Companies[$Vacancy->id]['welfare']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#a{{$Vacancy->id}}">公司福利</a>
                                    </div>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>       
        </div>
    </form>
</body>
</html>