<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.slim.min.js" integrity="sha256-MlusDLJIP1GRgLrOflUQtshyP0TwT/RHXsI1wWGnQhs=" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        .parent{
            position:absolute;
        }
        .left{
            position: relative;
            float:left;
            height: 350px;
            width: 200px;
        }
        .right{
            position: relative;
            float: left;
            height: 350px;
            width: 800px;
        }
        /* li{list-style-type:none;} */
    </style>

    <title>存儲工作</title>

    <script language="Javascript">
    $(document).ready(function(){
      $("#analysis").click(function(){
        var selected=[];
        $("[name=vacancy]:checkbox:checked").each(function(){
          selected.push($(this).val());
          });
        alert("選擇工作 : " + selected.join());
        });
      });
    </script>

</head>

<body>

<h1 class="text-block px-lg-4 my-lg-2">
    存儲工作
</h1>
<div class="parent">
    
    <div class="left">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item px-lg-4 my-lg-2">
                <a title="所有工作" href="/backend/work/web/">所有工作</a>
                @foreach ($VacancyCategoties as $VacancyCategoty)
                    <li class="nav-item px-lg-4 my-lg-2">
                        <a title="{{$VacancyCategoty->vacancy_category}}" href="/backend/work/web?vacancy_category={{$VacancyCategoty->vacancy_category}}">{{$VacancyCategoty->vacancy_category}}</a>
                    </li>        
                @endforeach
            </li>
        </ul>
    </div>
    <div class="right">
        <input id='analysis'class="btn-primary my-lg-1" type="button" value="分析"></input>
        
        <table class="table">
            <tr>
                <th></th>
                <th>職務名稱</th>
                <th>公司名稱</th>
            </tr>
            @foreach ($Vacancies as $Vacancy)
                <tr>
                    <td><input type="checkbox" name="works[]" value="{{$Vacancy->vacancy_name}}!{{$Companies[$Vacancy->id]['company_name']}}"></td>
                    <td><a href="{{$Vacancy->link}}">{{$Vacancy->vacancy_name}}</a></td>
                    <td><a href="{{$Companies[$Vacancy->id]['link']}}">{{$Companies[$Vacancy->id]['company_name']}}</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
</body>

