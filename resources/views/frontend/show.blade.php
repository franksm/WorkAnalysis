<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script language="javascript">
    　　function openwin() {
    　　    window.open ("/page", "newwindow", "height=100, width=400,toolbar=no,menubar=no, scrollbars=no, resizable=no, location=no, status=no")
    　　}
    </script>
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
                            <td>{{$Vacancy->id}}</td>
                            <td>
                                @foreach ($Tools[$Vacancy->id] as $Tool)
                                    <p>{{$Tool['vacancy_tool']}},</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($Categories[$Vacancy->id] as $Category)
                                    <p>{{$Category['vacancy_category']}},</p>
                                @endforeach
                            </td>
                            <td>
                                
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>       
    </div>