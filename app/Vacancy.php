<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    //
    public function category()
    {
        return $this->belongsToMany('App\VacancyCategory','vacancy_category_tags');
    }
    public function tool()
    {
        return $this->belongsToMany('App\VacancyTool','vacancy_tool_tags');
    }
}
