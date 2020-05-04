<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class processVacancyResumeController extends Controller
{
    public function processVacancyWeights($resumeCollect,$vacanciesInfo,$vacancyType){
        foreach($vacanciesInfo as $vacancyInfoKey=>$vacancyInfo){
            $vacancyCollect = collect($vacancyInfo);
            $vacancyItemCount=$vacancyCollect->count();
            $bothItemCount=$resumeCollect->diff($vacancyInfo[$vacancyType]);
        }
        return ["resumeItemCount"=>$resumeItemCount,"vacancyItemCount"=>$vacancyItemCount,"bothItemCount"=>$bothItemCount];
    }

}
