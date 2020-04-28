<script language="javascript">
    　　function openwin() {
    　　    window.open ("/page", "newwindow", "height=100, width=400,toolbar=no,menubar=no, scrollbars=no, resizable=no, location=no, status=no")
    　　}
    </script>
<div class="tag">
        @if(count($Vacancies)>0)
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
                                    <p>{{$Tool['vacancy_tool']}},</p>
                                @endforeach
                            </th>
                            <th>
                                @foreach ($Categories[$Vacancy->id] as $Category)
                                    <p>{{$Category['vacancy_category']}},</p>
                                @endforeach
                            </th>
                            <th>
                                {{-- <form action="/page" method="POST">
                                    
                                    <input type="submit" value="送出表單">
                                </form> --}}
                                <p>{{$Companies[$Vacancy->id]['welfare']}}</p>
                                {{-- <button onclick="openwin()" value="{{$Companies[$Vacancy->id]['welfare']}}">Click me</button> --}}
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>       
        @else
            <p>未含有任何職缺</p>
        @endif
    </div>