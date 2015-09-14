<?php


class LoginController {
    
    //loginview object
    private $v;
    
    //loginmodel object
    private $lm;
    
    //input values
    private $UserN;
    private $Pass;
    
    private $LogInValidation;
    
    //sets the object references.
    public function __construct($v, $lm){
        $this -> v = $v;
        $this -> lm = $lm;
    }
    
    //Initiate function that checks for button clicks.
    public function init(){
        //Has the user pressed login? CheckLoginInfo function
        if ($this -> v -> hasPressedSubmit())
        {
            $this -> lm -> CheckLoginInfo($this -> v -> getRequestUserName(), $this -> v -> getRequestUserPassword());
        }
        //Has the user pressed logout? Run Logout function
        if($this -> v -> hasPressedLogOut()){
            $this -> lm -> LogOut();
        }
    }
    
}