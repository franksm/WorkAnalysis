<?php
namespace App\Http\Controllers\Math; 

class ComputeSetSimilar
{
    public function computeSetSimilar($benchSet,$selfSet){
        $intersectCount=count(array_intersect($benchSet,$selfSet));
        $mergeCount=count((array_merge($benchSet,$selfSet)));
        $setSimilarity=$intersectCount/$mergeCount;
        $setPercent=$setSimilarity*100;
        return (int)$setPercent;
    }
}