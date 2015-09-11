<?php

class LoginController {
    
    private $v;
    
    private $UserN;
    private $Pass;
    
    public function __construct($v){
        $this -> v = $v;
    }
    
    public function init(){
        if ($this -> v -> hasPressedSubmit())
        {
            $this -> getLoginData();
        }
    }
    
    public function getLoginData(){
        $Pass = $this -> v -> getRequestUserPassword();
        $UserN = $this -> v -> getRequestUserName();
        //echo "Jag har nu hämtat login data ".$UserN;
    }
    
    
}