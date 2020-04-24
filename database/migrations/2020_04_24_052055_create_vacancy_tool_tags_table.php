<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancyToolTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_tool_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vacancy_id')->unsigned();
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
            $table->integer('tool_id')->unsigned();
            $table->foreign('tool_id')->references('id')->on('vacancy_tools')->onDelete('cascade');
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
        Schema::dropIfExists('vacancy_tool_tags');
    }
}
