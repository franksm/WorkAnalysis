<?php
namespace App\Http\Controllers\api;

use Illuminate\Support\Collection;

class Match
{
    public function __construct($compareArray,$beCompareArray){
        $this->compare=$compareArray;
        $this->beCompare=$beCompareArray;
    }
    private function set(){
        $compareArrayCollection=collection($this->compare);
        return $compareArrayCollection;
    }
    public function match(){
        $Match=0;
        $collectionParameter=set();
        $InCompare=$collectionParameter->diff($this->beCompare);
        $Match+=$InCompare->count();
        return $Match;
    }
}