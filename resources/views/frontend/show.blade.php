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
    <div class="tag">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>需求技能</th>
                                <th>職缺種類</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Vacancies as $Vacancy)
                            <tr>
                                <th>{{$Vacancy->id}}</th>
                                <th>
                                    @foreach ($Tools[$Vacancy->id] as $Tool)
                                        {{$Tool['vacancy_tool']}},
                                    @endforeach
                                </th>
                                <th>
                                    @foreach ($Categories[$Vacancy->id] as $Category)
                                        {{$Category['vacancy_category']}},
                                    @endforeach
                                </th>
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
                                                    <p>{{$Companies[$Vacancy->id]['welfare']}}</p>
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
        
</body>
</html>