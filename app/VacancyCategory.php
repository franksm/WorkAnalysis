<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacancyCategory extends Model
{
    //
    public function vacancy()
    {
        return $this->belongsToMany('App\Vacancy','vacancy_category_tags','vacancy_id','category_id');
    }
}
