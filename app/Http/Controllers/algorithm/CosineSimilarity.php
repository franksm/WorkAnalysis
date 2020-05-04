<?php

namespace App\Http\Controllers\algorithm;

class CosineSimilarity
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
public function getMarkMod($arrParam){
    $strModDouble = 0;
    foreach($arrParam as $val){
    $strModDouble += $val * $val;
    }
    $strMod = sqrt($strModDouble);
    //是否需要保留小数点后几位
    return $strMod;
}

   /**
    * 获取标杆的元素个数
    * @param unknown_type $arrParam
    * @return number
    */
    public function getMarkLenth($arrParam){
        $intLenth = count($arrParam);
        return $intLenth;
    }
   /**
    * 对传入数组进行索引分配，基准点的索引必须为k，求夹角的向量索引必须为 'j'.
    * @param unknown_type $arrParam
    * @param unknown_type $index
    * @ruturn $arrBack
    */
    //履歷為k,職缺為j
    public function handIndex($arrParam, $index){
    foreach($arrParam as $key => $val){
        $in = $index.$key;
        $arrBack[$in] = $val;
    }
        return $arrBack;
    }
    /**
    * @param unknown_type $arrMark标杆向量数组（索引被处理过）
    * @param unknown_type $arrAnaly 分析向量数组 （索引被处理过） |array('j0'=>1,'j1'=>2....)
    * @param unknown_type $intLenth 向量的长度
    *
    */
    public function getCosine( $arrMark, $arrAnaly, $intLenth){
        $strVector = 0;
        $strCosine = 0;
        for($i = 0; $i < $intLenth; $i++){
            $strMarkVal = $arrMark['k'.$i];
            $strAnalyVal = $arrAnaly['j'.$i];
            $innerProduct=$strMarkVal * $strAnalyVal;
            $strVector += $innerProduct;
        }
        $arrAnalyMod = getMarkMod($arrAnaly); //求分析向量的模
        $strMarkMod = getMarkMod($arrMark);
        $strFenzi = $strVector;
        $strFenMu = $arrAnalyMod * $strMarkMod;
        $strCosine = $strFenzi / $strFenMu;
        if(0 !== (int)$strFenMu){
            $strCosine = $strFenzi / $strFenMu;
        }
        return $strCosine;
    }    
}
