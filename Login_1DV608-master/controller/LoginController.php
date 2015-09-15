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
            try{
               //if(
                    $this -> lm -> CheckLoginInfo($this -> v -> getRequestUserName(), $this -> v -> getRequestUserPassword());

                    //On the original log in, it shows the Welcome message
                    $this -> v -> JustLoggedIn();
            }
            catch(Exception $e){
                //catches an error are uses the message as a status message
                $this -> v -> setStatusMessage($e);
            }
            
        }
        
        //Has the user pressed logout? Run Logout function
        if($this -> v -> hasPressedLogOut()){
            //if(
            try {
                $this -> lm -> LogOut();
                
                //on the original logout it shows the bye bye message
                $this -> v -> JustLoggedOut();
            }
            catch(Exception $e){
                //catches an error are uses the message as a status message
                $this -> v -> setStatusMessage($e);
            }
        }
    }
    
}