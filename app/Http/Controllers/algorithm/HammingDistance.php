<?php
namespace App\Http\Controllers\algorithm;

use Illuminate\Support\Collection;

class HammingDistance
{
    public function __construct($compareArray,$beCompareArray){
        $this->compare=$compareArray;
        $this->beCompare=$beCompareArray;
    }
    private function set(){
        $compareArrayCollection=collection($this->compare);
        $beCompareArrayCollection=collection($this->beCompare);
        return ["compare"=>$compareArrayCollection,"beCompare"=>$beCompareArrayCollection];
    }
    public function method(){
        $Distance=0;
        $collectionParameter=set();
        $justInCompare=$collectionParameter['compare']->diff($this->beCompare);
        $justInBeCompare=$collectionParameter['beCompare']->diff($this->compare);
        $Distance+=$justInCompare->count()+$justInBeCompare->count();
        return $Distance;
    }
}