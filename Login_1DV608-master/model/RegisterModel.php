<?php



class RegisterModel {
    
    private static $UserDAL;
    
    private static $dbFile;
    private static $FileContents;
    
    public function __construct($DAL){
        self::$UserDAL = $DAL;
    }
    
    public function Register($Username, $Password, $PasswordCheck){
        
        if (self::ValidateData($Username, $Password, $PasswordCheck)){
            //hashing the password before going to the DAL just to make sure no bugg in the DAL will cause an unhased password to be stored.
            self::$UserDAL -> AddUser($Username, sha1(file_get_contents("../Data/salt.txt")+$Password));
        }
    }
    
    private function ValidateData($Username, $Password, $PasswordCheck){
        //TODO:Check if $Username exists in "database"
        $RegisterdUsers = self::$UserDAL -> getUnserializedUsers();
        if($RegisterdUsers != false){
            foreach($RegisterdUsers as $Ruser){
                if($Username == $Ruser -> getUserName()){
                    throw new Exception("User exists, pick another username.");
                }
            }
        }
        
        //username has to be ATLEAST 3 chaacters and password has to be ATLEAST 6 characters long.
        //user name may not contain HTML tags (4.9)
        if($Username != strip_tags($Username)){
            throw new Exception("Username contains invalid characters.");
        }
        if($Password != strip_tags($Password)){
            throw new Exception("Password contains invalid characters.");
        }
        if($Password != $PasswordCheck){
            throw new Exception("Passwords do not match.");
        }
        if(strlen($Username) < 3 && strlen($Password) <= 6){
            throw new Exception("Username has too few characters, at least 3 characters. <br/>Password has too few characters, at least 6 characters.");
        }
        if(strlen($Username) < 3){
            throw new Exception("Username has too few characters, at least 3 characters.");
        }
        if(strlen($Password) < 6){
            throw new Exception("Password has too few characters, at least 6 characters.");
        }
        
        
   
        return true;
    }
    
    
    //returns the dbFile
    public function getDataFile(){
        return self::$dbFile;
    }
}