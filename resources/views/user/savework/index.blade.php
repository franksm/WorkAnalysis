@extends('layouts.app')
@section('title', '存儲工作')
@section('content')

    <style type="text/css">
        .parent{
            top: 60px;
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
    </style>

    <script language="JavaScript">
        function validate(form1)
        {   
            var chk_arr =  document.getElementsByName("works[]");
            var chklength = chk_arr.length;
            for(k=0;k< chklength;k++)
            {
                if(chk_arr[k]['checked']==true){
                    return true;
                }
            } 
            alert("請勾選職缺");
            return false;
        }
        function check_all(obj,cName)
        {
            var checkboxs = document.getElementsByName(cName);
            for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;}
        }
    </script>

<div class="parent">
    
    <div class="left">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item px-lg-4 my-lg-2">
                <a title="所有工作" href="/user/saveWork/">所有工作</a>
            </li>
            <li class="nav-item px-lg-4 my-lg-2">
                <a title="軟體設計工程師" href="/user/saveWork?vacancy_category=軟體設計工程師">軟體設計工程師</a>
            </li>
            <li class="nav-item px-lg-4 my-lg-2">
                <a title="所有工作" href="/user/saveWork?vacancy_category=行政人員">行政人員</a>
            </li>
        </ul>
    </div>
    <div class="right">
        <form action="{{ route('analysis.list') }}" method="post" onSubmit="return validate(this)">
            {{ csrf_field() }}
            <input type="submit" value="送出表單" class="btn btn-primary my-lg-1">
        <table class="table">
            <tr>
                <th><input type="checkbox" name="all" onclick="check_all(this,'works[]')" /></th>
                <th>職務名稱</th>
                <th>公司名稱</th>
            </tr>
            @foreach ($score as $key=>$value)
                <tr>
                    <td><input type="checkbox" name="works[]" value="{{$key+1}}"></td>
                    <td><a href="{{$Vacancies[$key]['link']}}">{{$Vacancies[$key]['vacancy_name']}}</a></td>
                    <td><a href="{{$Companies[$Vacancies[$key]['company_id']]['link']}}">{{$Companies[$Vacancies[$key]['company_id']]['company_name']}}</a></td>
                </tr>
            @endforeach
        </table>
        </form>
    </div>
</div>
@endsection

