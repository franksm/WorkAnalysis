<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacancyCategoryTag extends Model
{
    protected $fillable = [
        'vacancy_id',
        'categor_id'
    ];
}
