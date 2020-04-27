<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function vacancy()
    {
        return $this->hasMany('App\Vacancy');
    }
}
