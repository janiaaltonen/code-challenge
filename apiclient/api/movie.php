<?php

class Movie{
    private string $data = '';

    public function __construct($obj){
        $temp_value = "\n";
        foreach ($obj as $key => $value){
            if (is_array($value)){
                foreach ($value as $item){
                    $temp_value .= $item->Source. ": ". $item->Value. "\n";
                }
                $value = $temp_value;
            }
            $this->data .= $key. ": ". $value. "\n";
        }
    }

    public function getMovie(): string{

        return $this->data;
    }


}