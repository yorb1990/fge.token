<?php
namespace fge\token\src;
class token extends dictionary{
    protected $t='';
    protected $c='';
    protected $l=10;
    function __construct($T,$C,$L){
        $this->t=$T;
        $this->c=$C;
        $this->l=$L;
    }
    protected function valited(&$error){                
        if($this->c==''){
            $error='error en el cvv';
            return false;
        }
        $cn=$this->c;
        if($this->CreateCVV($error)){
            if($this->c==$cn){
                return true;
            }
            $error='combinacion cvv y nuc invalido';
            return false;
        }
        return false;
    }
    protected function CreateCVV(&$error)
    {        
        if($this->t==''&&strlen($this->t)>$this->l-1){
            $error='error en el token (error de ingreso, la longitud no cumplida)';
            return false;
        }
        $this->c="";
        for($i=0,$num=-1;$i<strlen($this->t);$i++){      
            if($this->CalcCVV_pair($num,$i)){
                $this->c=$this->c.$this->GetByIndex(($num>0?$num:1)-1);            
                $num=-1;
            }
        }        
        return true;        
    }
    private function CalcCVV_pair(&$num,$i){
        if($num==-1){
            $num=$this->GetIndexByText($this->t[$i]);   
            return false;
        }
        $num=(int)($num+$this->GetIndexByText($this->t[$i]))/2;                                           
        return true;        
    }
    protected function CreateTOKEN(){
        $this->t="";
        for($i=0 ; $i < $this->l;$i++){
            $this->t=$this->t.$this->GetRandom();
        }
    }
    protected function create(&$error)
    {
        $this->CreateTOKEN();
        return $this->CreateCVV($error);
    }
}