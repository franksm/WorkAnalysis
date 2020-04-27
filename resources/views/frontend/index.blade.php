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
                <a title="所有工作" href="/web">所有工作</a>
            </li>
            <li class="nav-item px-lg-4 my-lg-2">
                <a title="工程師" href="/a">工程師</a>
            </li>
            <li class="nav-item px-lg-4 my-lg-2">
                <a title="業務" href="/b">業務</a>
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
            <tr>
                <td><input type="checkbox" name="vacancy" value="前端工程師(人力銀行)/104人力銀行_一零四資訊科技股份有限公司"></td>
                <td><a href="https://www.104.com.tw/job/69yqx?jobsource=pda_b">前端工程師(人力銀行)</a></td>
                <td><a href="https://www.104.com.tw/company/12v3o7uw?jobsource=pda_b">104人力銀行_一零四資訊科技股份有限公司</a></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="vacancy" value="React Native 工程師/新加坡商海宇顧問服務有限公司台灣分公司"></td>
                <td><a href="https://www.104.com.tw/job/6wuo1?jobsource=pda_b">React Native 工程師</a></td>
                <td><a href="https://www.104.com.tw/company/1a2x6bkq1g?jobsource=pda_b">新加坡商海宇顧問服務有限公司台灣分公司</a></td>
            </tr>
        </table>
    </div>
</div>
</body>

