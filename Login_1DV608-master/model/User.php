<?php

class User{
    private $userName;
    private $userPassword;
    
    public function __construct($userName, $password){
        $this -> userName = $userName;
        $this -> userPassword = $password;
    }
    
    public function getUserName(){
        return $this -> userName;
    }
    
    public function getHasedPassword(){
        return $this -> userPassword;
    }
}