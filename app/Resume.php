<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'age',
        'born',
        'experience',
        'eduction'
    ];

    public function category()
    {
        return $this->belongsToMany('App\VacancyCategory','resume_category_tags','resume_id','category_id');
    }
    public function tool()
    {
        return $this->belongsToMany('App\VacancyTool','resume_tool_tags','resume_id','tool_id');
    }
    public function user()
    {
        return $this->hasone('App\User','id','user_id');
    }
}
