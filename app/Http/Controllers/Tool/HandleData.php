<?php
namespace App\Http\Controllers\Tool;

class HandleData
{
    private function handleFieldItemArray($fieldItemArray,$ifInFile){
        foreach($fieldItemArray as $fieldKey=>$fieldItem){
            if ($fieldItem=="不拘"){
                $fieldItemArray[$fieldKey]=$ifInFile;
            }
            else{
                $notInfile=array_diff_key($ifInFile,$fieldItem);
                $fieldItemArray[$fieldKey]=array_merge($fieldItem,$notInfile);
            }
        }
        return $fieldItemArray;
    }
    public function handleData($field,$fieldType,$resumeField){
        $fieldItemArray=[];
        $allFieldItemArray=[];
        $allFieldItem=[];
        $field[]=$resumeField;
        foreach($field as $fieldIndex=>$fieldItem){
            foreach ($fieldItem as $fieldAttribute){
                if($fieldAttribute[$fieldType]=="不拘"){
                    $fieldItemArray[$fieldIndex-1]=[];
                }
                else{
                    $fieldItemArray[$fieldIndex-1][$fieldAttribute[$fieldType]]=$fieldAttribute['weight'];
                    $allFieldItemArray[$fieldAttribute[$fieldType]]=0;
                    }
                }
        }
        $fieldItemArray=$this->handleFieldItemArray($fieldItemArray,$allFieldItemArray);
        return $fieldItemArray;
    }
}