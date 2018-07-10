<?php
namespace fge\token\src;
class dictionary {
    public function GetRandom(){
        return $this->Getarr()[rand(0,count($this->Getarr())-1)];
    }        
    public function GetCount(){
        return count($this->Getarr());
    }
    public function GetByIndex($num){
        return $this->Getarr()[$num];
    }    
    public function GetIndexByText($text){
        return array_search($text,$this->Getarr());
    }
    public function Getarr(){
        return [
            'B','A','0','9','8','7',
            'N','M','L','K','J','I',
            'Z','Y','X','W','V','U',
            '6','5','4','3','2','1',
            'H','G','F','E','D','C',
            'T','S','R','Q','P','O'
        ];
    }
}
