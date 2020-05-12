<?php
namespace App\Http\Controllers\Statistics; 

class ComputeCosine
{
    /**
    * 数据分析引擎
    * 分析向量的元素 必须和基准向量的元素一致，取最大个数，分析向量不足元素以0填补。
    * 求出分析向量与基准向量的余弦值
    * @author yu.guo@okhqb.com
    */
    /**
    * 获得向量的模
    * @param unknown_type $array 传入分析数据的基准点的N维向量。|eg:array(1,1,1,1,1);
    */
    private function getMarkMod($arrMultiply){
        $strModDouble = 0;
        foreach($arrMultiply as $multiply){
            if ($multiply==0){
                continue;
            }
        $strModDouble += $multiply * $multiply;
        }
        $strMod = sqrt($strModDouble);
        //是否需要保留小数点后几位
        return $strMod;
    }
    private function vector($arrMark,$arrAnaly){
        $strVector=0;
        foreach($arrMark as $markIndex=>$markValue){
            if($arrAnaly[$markIndex]==0 or $markValue==0){
                continue;
            }
            $strVector=+$arrAnaly[$markIndex]*$markValue;
        }
        return $strVector;
    }
    /**
    *
    * @param unknown_type $arrMark标杆向量数组（索引被处理过）
    * @param unknown_type $arrAnaly 分析向量数组 （索引被处理过） |array('j0'=>1,'j1'=>2....)
    * @param unknown_type $strMarkMod标杆向量的模
    * @param unknown_type $intLenth 向量的长度
    */
    public function getCosine($arrMark,$arrAnaly){
        $strCosine = 0;
        $strVector=0;
        $strVector=$this->vector($arrMark,$arrAnaly);
        $strAnalyMod = $this->getMarkMod($arrAnaly);//求分析向量的模
        $strMarkMod = $this->getMarkMod($arrMark);//求分析向量的模
        $strFenMu = $strAnalyMod * $strMarkMod;
        if ($strFenMu!=0){
        $strCosine = $strVector / $strFenMu;
        }
        else{
            $strCosine=0.1;
        }
        return $strCosine;
    }
}