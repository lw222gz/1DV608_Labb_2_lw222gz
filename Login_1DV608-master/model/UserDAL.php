<?php

class UserDAL {
    
    //private static $Users = array();
    
    private static $path = "../Data/database.bin";
    
    public function __construct(){
        //checks if file exists, otherwise it's created
        if(!file_exists(self::$path)){
            self::$dbFile = fopen(self::$path, "w");
        }
        /*$user = array();
        array_push($user, new User("Admin", "Password"));
        $serialise = serialize($user);
        file_put_contents(self::$path, $serialise);*/
    }
    
    public function AddUser($userName, $hasedPassword){

        $Users = self::getUnserializedUsers();
        if($Users == false){
            //if Users == false, then the .bin is empty and it returns false, thus I make the varibel to an array manually so arrau_push dont crash.
            $Users = array();
        }
        array_push($Users, new User($userName, $hasedPassword));
        //re-searializes the array and puts all the data back in the file.
        $SerializedUsers = serialize($Users);
        file_put_contents(self::$path, $SerializedUsers);
    }
    
    //returns all user data unseralized
    public function getUnserializedUsers(){
        return unserialize(file_get_contents(self::$path));
    }

}