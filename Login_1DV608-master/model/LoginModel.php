<?php

//session start
session_start();

class LoginModel {
    
    //Correct login info
    private static $CorrectUserN = "Admin";
    private static $CorrectPassword = "Password";
    
    
    public function __construct(){
        //When page is refreshed, the user stays logged in.
        if(isset($_SESSION["isLoggedin"]) && !empty($_SESSION["isLoggedin"])) {
            $_SESSION["isLoggedin"] = true;
        }
    }
    
    //Takes the given data and throws a proper Exception if anything is wrong, 
    //otherwise returns @boolean
    public function CheckLoginInfo($UserN, $Pass) {
        //Trims both user inputs 
        $UserN = trim($UserN);
        $Pass = trim($Pass);
        
        //When an Exception is thrown, the controller will pick that exception up, 
        //pass it on to the view that uses the message in the exception to present it to the user.
        if(empty($UserN)){

            throw new Exception('Username is missing');
        }
        else if(empty($Pass)){
            throw new Exception('Password is missing');
        }
        else if($UserN === self::$CorrectUserN && $Pass === self::$CorrectPassword){
            //If this session allready exsists and is true, then it's a repost, 
            //if it's a repost I throw an empty error to remove the StatusMessage
            if(isset($_SESSION["isLoggedin"]) && $_SESSION["isLoggedin"] == true){
                throw new Exception();
            }
            //Otherwise it's the origninal login and the user will be logged in for the first time with the welcome message
            $_SESSION["isLoggedin"] = true;
        }
        //If none above, the user entered wrong credentials.
        else {
            throw new Exception('Wrong name or password');
        }
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
        //If this session allready exsists and it's value is false, then it's a repost, 
        //if it's a repost I throw an empty error to remove the StatusMessage
        if (isset($_SESSION["isLoggedin"]) && !$_SESSION["isLoggedin"]){
            throw new Exception();
        }
        
        //Otherwise the person just logged out and the bye bye message will be shown.
        $_SESSION["isLoggedin"] = false;
    }
}