<?php
namespace App\Http\Controllers\Math; 

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
private function getMarkMod($arrMultiply,$arrSum){
    $strModDouble = 0;
    foreach($arrMultiply as $multiply){
        $strModDouble += $multiply * $multiply;
    }
    foreach($arrSum as $sum){
        $strModDouble += $sum;
    }
    $strMod = sqrt($strModDouble);
    //是否需要保留小数点后几位
    return $strMod;
    }
    /**
    * 对传入数组进行索引分配，基准点的索引必须为k，求夹角的向量索引必须为 'j'.
    * @param unknown_type $arrParam
    * @param unknown_type $index
    * @ruturn $arrBack
    */
    private function handIndex($arrParam, $index){
        foreach($arrParam as $key => $val){
            $in = $index.$key;
            $arrBack[$in] = $val;
        }
        return $arrBack;
    }
    private function vector($sumBoth,$multiplyMark,$multiplyAnaly){
        $strVector=0;
        $arrMark=$this->handIndex($multiplyMark,'k');
        $arrAnaly=$this->handIndex($multiplyAnaly,'j');
        $arrBoth=$this->handIndex($sumBoth,'b');
        $arrLenth=count($arrBoth);
        for($i = 0; $i < $arrLenth; $i++){
            $strMarkVal = $arrMark['k'.$i];
            $strAnalyVal = $arrAnaly['j'.$i];
            $strSelfVal = $arrBoth['b'.$i];
            $strVector += $strMarkVal * $strAnalyVal;
            $strVector += $strSelfVal;
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
    public function getCosine($sumMark,$sumAnaly,$sumBoth,$multiplyMark,$multiplyAnaly){
        $strCosine = 0;
        $strVector=0;
        $strVector=$this->vector($sumBoth,$multiplyMark,$multiplyAnaly);
        $strFenzi = $strVector;
        $strMarkMod = $this->getMarkMod($multiplyMark,$sumMark);//求分析向量的模
        $strAnalyMod = $this->getMarkMod($multiplyAnaly,$sumAnaly);//求分析向量的模
        $strFenMu = $strAnalyMod * $strMarkMod;
        if((int)$strFenMu !== 0){
            $strCosine = $strFenzi / $strFenMu;
        }
        return $strCosine;
    }
}