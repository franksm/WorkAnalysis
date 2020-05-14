<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vacancy_name',50);//職缺名稱
            $table->string('vacancy_category',10);//職缺類別
            $table->string('salary_category',10);//薪資類型
            $table->string('salary',20);//薪資
            $table->string('work_nature',4);//工作性質
            $table->string('company_id',20);//公司id
            $table->string('claim_education',10);//需求學歷
            $table->float('weight_education',10)->nullable();//學歷權重
            $table->string('claim_experience',4);//工作經歷
            $table->float('weight_experience',4)->nullable();//工作權重
            $table->string('claim_people',4);//需求人數
            $table->string('management_responsibility',20);//是否附管理責任
            $table->string('expatriate',20);//是否出差外派
            $table->string('link');//細項
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
}
