@extends('layouts.app')
@section('header_title', 'Edit Vacancy')
@section('content')

<br>
<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('.selectCategory').select2({placeholder: "Select Category"});
      var VacancyCategories = {!! json_encode($VacancyCategories); !!};
      $(".selectCategory").val(VacancyCategories).trigger("change");

  });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.selectTool').select2({placeholder: "Select Tool"});
        var VacancyTools = {!! json_encode( $VacancyTools); !!};
        $(".selectTool").val(VacancyTools).trigger("change");
    });
</script>

<div class="container">
<div class="col-12">
<form action="{{ route('backend.work.vacancy.update',$Vacancies->id) }}" method="POST" name="add_vacancy">
{{ csrf_field() }}
@method('PATCH')
        <div class="form-group">
            <strong>職缺名稱</strong>
            <input type="text" name="vacancy_name" class="form-control" placeholder="請輸入職缺名稱" value="{{ $Vacancies->vacancy_name }}">
            <span class="text-danger">{{ $errors->first('vacancy_name') }}</span>
        </div>
        <div class="form-group">
            <strong>公司名稱</strong>
            <input type="text" name="company_name" class="form-control" placeholder="請輸入公司名稱" value="{{ $Vacancies->company_name }}">
            <span class="text-danger">{{ $errors->first('company_name') }}</span>
        </div>
        <div class="form-group">
            <strong>工作經歷</strong>
            <input type="text" name="claim_education" class="form-control" placeholder="請輸入工作經歷" value="{{ $Vacancies->claim_education }}">
            <span class="text-danger">{{ $errors->first('claim_education') }}</span>
        </div>
        <div class="form-group">
            <strong>學歷</strong>
            <input type="text" name="claim_experience" class="form-control" placeholder="請輸入學歷" value="{{ $Vacancies->claim_experience }}">
            <span class="text-danger">{{ $errors->first('claim_experience') }}</span>
        </div>
        <div class="form-group">
            <strong>縣市</strong>
            <input type="text" name="region" class="form-control" placeholder="請輸入所在縣市" value="{{ $Vacancies->region }}">
            <span class="text-danger">{{ $errors->first('region') }}</span>
        </div>
        <div class="form-group">
            <strong>縣市區段</strong>
            <input type="text" name="area" class="form-control" placeholder="請輸入所在縣市區段,如:高雄市'苓雅區',其中的苓雅區" value="{{ $Vacancies->area }}">
            <span class="text-danger">{{ $errors->first('area') }}</span>
        </div>
        <div class="form-group">
            <strong>新增擅長工具</strong><br>
            <select class="selectTool" style="width:100%;" name="VacancyTools[]" multiple="multiple" required>
                @foreach ($VacancyToolAll as $VacancyTool)
                    <option value='{{ $VacancyTool->id }}'>{{$VacancyTool->vacancy_tool}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <strong>新增職缺種類</strong><br>
            <select class="selectCategory" style="width:100%;" name="VacancyCategories[]" multiple="multiple" required>
                @foreach ($VacancyCategoryAll as $VacancyCategory)
                    <option value='{{ $VacancyCategory->id }}'>{{$VacancyCategory->vacancy_category}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>
@endsection
