<?php
namespace App\Http\Controllers\Tool;

class HandleData
{
    private function handleFieldItemArray($fieldItemArray,$ifInFile){
        foreach($fieldItemArray as $fieldKey=>$fieldItem){
            if ($fieldItem=="不拘"){
                $fieldItemArray[$fieldKey]=$ifInFile['notInFile'];
            }
            else{
                $notInfield=array_diff_key($ifInFile['notInFile'],$fieldItem);
                $infield=array_intersect_key($ifInFile['inFile'],$fieldItem);
                $fieldItemArray[$fieldKey]=array_merge($infield,$notInfield);
            }
        }
        return $fieldItemArray;
    }
    private function adjustmentData($allFieldItemArray,$allItemLen){
        $ifInFile=[];
        foreach($allFieldItemArray as $index=>$item){
            $ifInFile['notInFile'][$index]=-($item['weight']*$item['count'])/$allItemLen;
            $ifInFile['inFile'][$index]=$allFieldItemArray[$index]['weight']+$ifInFile['notInFile'][$index];
        }
        return $ifInFile;
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
                    if (isset($allFieldItemArray[$fieldAttribute[$fieldType]])){
                        $allFieldItemArray[$fieldAttribute[$fieldType]]['count']++;
                    }
                    else{
                        $allFieldItemArray[$fieldAttribute[$fieldType]]['weight']=$fieldAttribute['weight'];
                        $allFieldItemArray[$fieldAttribute[$fieldType]]['count']=1;
                        $allFieldItem[$fieldAttribute[$fieldType]]=0;
                        }
                    }
                }
        }
        $allItemLen=count($fieldItemArray);
        $ifInFile=$this->adjustmentData($allFieldItemArray,$allItemLen);
        $fieldItemArray=$this->handleFieldItemArray($fieldItemArray,$ifInFile);
        return $fieldItemArray;
    }
}