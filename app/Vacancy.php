<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    //
    protected $fillable = [
        'vacancy_name',
        'company_name',
        'claim_education',
        'claim_experience',
    ];
    public function category()
    {
        return $this->belongsToMany('App\VacancyCategory','vacancy_category_tags','vacancy_id','category_id');
    }
    public function tool()
    {
        return $this->belongsToMany('App\VacancyTool','vacancy_tool_tags','vacancy_id','tool_id');
    }
    public function company()
    {
        return $this->hasone('App\Company','id','company_id');
    }
}
