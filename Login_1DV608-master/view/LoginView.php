<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	
	//used to give the correct value to $message in response()
	private static $ErrorMess = '';
	


	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = self::$ErrorMess;
		
		$response = $this->generateLoginFormHTML($message);
		//$response .= $this->generateLogoutButtonHTML($message);
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="Admin" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	
	//returns user login name
	public function getRequestUserName() {
		//isset doesnt work for me? Ask during a lecture
		
		//$userName = str_replace(' ', '', $_POST['LoginView::UserName']);
		
		//checks if the user name box is empty
		if(!empty($_POST['LoginView::UserName'])){
			return  $_POST['LoginView::UserName'];
		}
		else{
			//sets an appropriate error message
			self::$ErrorMess = 'Username is missing';
		}
		return null;
	}
	
	
	
	//returns user password
	public function getRequestUserPassword(){
		//$pass = str_replace(' ', '', $_POST['LoginView::Password']);
		
		//checks if the password box is empty
		if(!empty($_POST['LoginView::Password'])){
			return $_POST['LoginView::Password'];
		}
		else{
			//sets an appropriate error message
			self::$ErrorMess = 'Password is missing';
		}
		return null;
	}
	
	//checks if the login button has been pressed.
	public function hasPressedSubmit(){
		if(isset($_POST['LoginView::Login'])){
			return true;
		}
		return false;
	}
}