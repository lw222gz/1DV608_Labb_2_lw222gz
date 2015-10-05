<?php


class LoginController {
    
    //loginview object
    private $v;
    
    //loginmodel object
    private $lm;
    
    //registerview object.
    private $rv;
    
    //register model object
    private $rm;
    
    //input values
    private $UserN;
    private $Pass;
    
    //sets the object references.
    public function __construct($v, $lm, $rv, $rm){
        $this -> v = $v;
        $this -> lm = $lm;
        $this -> rv = $rv;
        $this -> rm = $rm;
    }
    
    //Initiate function that checks for button clicks.
    public function init(){
        
        if($this -> rv -> hasPressRegister()){
            try
            {
                //validates input data and registers a user.
                $this -> rm -> Register($this -> rv -> getRequestUserName(), $this -> rv -> getRequestPassword(), $this -> rv -> getRequestPasswordCheck());
                //redirects registerd newly registed user to login
                
                //CONTINUE, the redirect is working, but the username is not saved. Also, the CSquiz does not pick up the redirect, bugg or something with my page?
                $this -> v -> setNewUserName($this -> rv -> getRequestUserName());
                //var_dump($_SERVER);
                //$actualURL = $_SERVER[HTTP_HOST].$_SERVER[PHP_SELF];
                
                header("Location: /Login_1DV608-master/");
                //var_dump($actualURL);
            }
            catch (Exception $e){
                $this -> rv -> setErrorMessage($e);
            }
        }
        
        //Has the user pressed login? CheckLoginInfo function
        if ($this -> v -> hasPressedSubmit())
        {
            try{
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
        else if($this -> v -> hasPressedLogOut()){
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