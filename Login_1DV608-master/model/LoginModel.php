<?php

//session start
session_start();

class LoginModel {
    
    //Correct login info
    private static $CorrectUserN = "Admin";
    private static $CorrectPassword = "Password";
    
    private static $Message = '';
    
    
    
    
    public function __construct(){
        //When page is refreshed, the user stays logged in.
        if(isset($_SESSION["isLoggedin"]) && !empty($_SESSION["isLoggedin"])) {
            $_SESSION["isLoggedin"] = true;
        }
    }
    
    //Takes the given data and executes a proper response message
    public function CheckLoginInfo($UserN, $Pass) {
        //Trim both 
        $UserN = trim($UserN);
        $Pass = trim($Pass);
        
        
        if(empty($UserN)){
            self::$Message = 'Username is missing';
        }
        else if (empty($Pass)){
            self::$Message = 'Password is missing';
        }
        else if($UserN !== self::$CorrectUserN || $Pass !== self::$CorrectPassword) {
            self::$Message = 'Wrong name or password';
        }
        //If all the above are are false, the user has given the correct info and gets logged in into the 'system'
        else {
            //handels the 'Welcome' message
            if(isset($_SESSION["isLoggedin"]) && $_SESSION["isLoggedin"] == true){
                self::$Message = '';
            }
            else {
                self::$Message = 'Welcome';
            }
            //sets login status
            $_SESSION["isLoggedin"] = true;
        }
    }
    
    //returns status message
    public function getStatusMessage() {
        return self::$Message;
    }
    
    //@returns boolean, true if logged in, false if not logged in.
    public function getLoginStatus(){
        if(isset($_SESSION["isLoggedin"])){
            return $_SESSION["isLoggedin"];
        }
        else{
            return false;
        }
    }
    
    //Logs the user out of the 'system'
    public function LogOut(){
        if(isset($_SESSION["isLoggedin"])){
            //Handels the 'Bye bye!' message
            if($_SESSION["isLoggedin"] == false){
                self::$Message = '';
            }
            else {
                self::$Message = 'Bye bye!';
            }
            //Logs the user out and destroys the session
            $_SESSION["isLoggedin"] = false;
            session_destroy();
        }
    }
}