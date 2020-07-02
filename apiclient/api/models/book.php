<?php

class Book{
    private string $data = '';

    public function __construct($obj){
        foreach ($obj as $key=> $value){
            if($key){ $this->data .= $key;}
            if(is_object($value)){
                foreach ($value as $sKey => $sValue){
                    if($sKey){ $this->data .= "\n". $sKey. ": ";}
                    if(is_array($sValue)){
                        $this->data .= "\n";
                        foreach ($sValue as $item){
                            if(is_object($item)){
                                foreach ($item as $ovalue){
                                    if (is_object($ovalue)){
                                        if(!empty((array)$ovalue)){
                                            $this->data .= $ovalue. "\n";
                                        }
                                    }
                                    else {
                                        $this->data .= $ovalue. "\n";
                                    }
                                }
                            }
                        }
                    } elseif (is_object($sValue)){
                        foreach ($sValue as $gcKey=>$gcValue){
                            if(is_array($gcValue)){
                                if(count($gcValue) == 1){
                                    $this->data .= "\n". $gcKey. ": ";
                                    $this->data .= $gcValue[0];
                                }
                            } else {
                                $this->data .= $gcKey. ": ". $gcValue. "\n";
                            }
                        }
                        $this->data .= "\n";
                    } else {
                        $this->data.= $sValue. "\n";
                    }
                    $this->data .= "\n";
                }
            } else {
                $this->data .= " ". $value. "\n";
            }
        }
    }

    public function getBook(): string{
        return $this->data;
    }
}