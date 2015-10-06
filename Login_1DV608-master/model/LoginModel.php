<?php


class LoginModel {
    
    private static $UserDAL;
    
    
    public function __construct($DAL){
        self::$UserDAL = $DAL;
        //When page is refreshed, the user stays logged in.
        if(isset($_SESSION["isLoggedin"]) && !empty($_SESSION["isLoggedin"])) {
            $_SESSION["isLoggedin"] = true;
        }
    }
    
    //Takes the given data and throws a proper Exception if anything is wrong, 
    //otherwise returns @boolean
    public function CheckLoginInfo($UserN, $Pass) {
        
        $UserN = trim($UserN);
        $Pass = trim($Pass);
        
        $RegisterdUsers = self::$UserDAL -> getUnserializedUsers();
        
        if($RegisterdUsers == false){
            throw new Exception("No registerd users yet");
        }
        
        //When an Exception is thrown, the controller will pick that exception up, 
        //pass it on to the view that uses the message in the exception to present it to the user.
        if(empty($UserN)){

            throw new Exception('Username is missing');
        }
        else if(empty($Pass)){
            throw new Exception('Password is missing');
        }
        //If this session allready exsists and is true, then it's a repost, 
        //if it's a repost I throw an empty error to remove the StatusMessage
        else if(isset($_SESSION["isLoggedin"]) && $_SESSION["isLoggedin"] == true){
                throw new Exception();
        }
        $_SESSION["isLoggedin"] = false;
        //Otherwise it's the origninal login and the user credentials will be checked.
        foreach ($RegisterdUsers as $Ruser){
            if($UserN == $Ruser -> getUserName()){
                if(sha1(file_get_contents("../Data/salt.txt").$Pass) == $Ruser -> getHasedPassword()){
                    $_SESSION["isLoggedin"] = true;
                    break;
                }
            }
        }
        if(!$_SESSION["isLoggedin"]){
            throw new Exception('Wrong name or password');
        }
    }

    
    //@returns boolean, 
    //true if logged in, false if not logged in.
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