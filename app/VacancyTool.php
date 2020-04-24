<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacancyTool extends Model
{
    //
    public function vacancy()
    {
        return $this->belongsToMany('App\Vacancy','vacancy_tool_tags');
    }
}
