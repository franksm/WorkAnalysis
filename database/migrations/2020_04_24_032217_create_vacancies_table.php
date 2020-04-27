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
            $table->string('vacancy_name',20);//職缺名稱
            $table->string('job_category',4);//職缺類別
            $table->string('salary',20);//薪資
            $table->string('company_name',20);//公司名稱
            $table->string('claim_education',4);//需求學歷
            $table->string('claim_experience',4);//工作經歷
            $table->string('work_nature',4);//工作性質
            $table->string('claim_people',4);//需求人數
            $table->boolean('management_responsibility');//使否附管理責任
            $table->boolean('expatriate');//是否外派
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
