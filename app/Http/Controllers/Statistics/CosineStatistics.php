<?php
namespace App\Http\Controllers\Statistics; 

class CosineStatistics
{
    /**
    * 
    * @param unknown_type $array 獲得分母的值;
    */
    private function getMarkMod($arrMultiply){
        $strModDouble = 0;
        foreach($arrMultiply as $multiply){
            $strModDouble += $multiply * $multiply;
        }
        //是否需要保留小数点后几位
        $strMod = sqrt($strModDouble);
        return $strMod;
    }
    
    private function vector($arrMark,$arrAnaly){
        $strVector=0;
        foreach($arrMark as $markIndex=>$markValue){
            $strVector+=$arrAnaly[$markIndex]*$markValue;
        }
        return $strVector;
    }

    /**
    *
    * @param unknown_type $arrMark  自身的向量
    * @param unknown_type $arrAnaly 比較的向量
    */
    public function getCosine($arrMark,$arrAnaly){
        $strCosine = 0;
        $strVector=0;
        $strVector=$this->vector($arrMark,$arrAnaly);
        $strAnalyMod = $this->getMarkMod($arrAnaly);//其中一個分母被乘的值
        $strMarMod = $this->getMarkMod($arrMark);//另一個分母被乘的值
        $strFenMu = $strAnalyMod * $strMarMod;
        if ($strFenMu==0){
            return 0;
        }
        else{
            $strCosine = $strVector / $strFenMu;
        }
        return $strCosine;
    }
}