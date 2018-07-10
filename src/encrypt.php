<?php
namespace fge\token\src;
class encrypt{

    //private $plaintext = 'My secret message 1234';
    private $iv;
    private $password ;
    private $method = 'aes-256-cbc';
    function __construct($p){
        $this->iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        $this->password = substr(hash('sha256', $p, true), 0, 32);        
    }
    public function encryptTEXT($text){
        return base64_encode(openssl_encrypt($text, $this->method, $this->password, OPENSSL_RAW_DATA, $this->iv));
    }
    public function decryptTEXT($text){
        return openssl_decrypt(base64_decode($text), $this->method, $this->password, OPENSSL_RAW_DATA, $this->iv);        
    }    
}