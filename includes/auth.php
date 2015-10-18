<?php
	include_once("/var/www/includes/session.php");
	include_once("/var/www/includes/user.php");
//	include_once("/var/www/includes/captcha.php");
	include_once("/var/www/includes/crypt.php");
	include_once("/var/www/includes/error.php");
	
    function authenticate() {
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		$captcha  = trim($_POST["captcha"]);

		if($username == '' || $password == '' || $captcha == '' ) { 
			set_login_error("Any emtpy field is not allowed");
		} else { 
			include_once("/var/www/includes/captch_code.php");
			if(check_code($captcha)) { 
				$cr = new crypto();
				$password = $cr->one_way_crypt($password);
		
				$u = new user() ;
				if($u->validate_user($username, $password)) {	
					$session = new user_session();
					setcookie('app_session_id',  
						$session->create_session_id($u->get_uid(),$u->get_uname(),$u->get_email()));

					session_register($username);

					header("Location: /challenges.php");
				}
				else { 
					set_login_error("Authentication Failed");
				}
			}else {
					set_login_error("Invalid Captcha");
			}
		} 
    }	

	function logout() {
		setcookie('app_session_id');
		session_destroy();
		header("Location: /logout.php");
	}	
	
	function validate_session()
	{
		if($_COOKIE['app_session_id'] == '')
			header("Location: /index.php");	
	}

	function register_user()
	{
		$username = $_POST["username"];
		$email	  = $_POST["email"];
		$password = $_POST["password"];
		$captcha  = trim($_POST["captcha"]);

		//if not valid captcha()
		include_once("/var/www/includes/captch_code.php");
		if(check_code($captcha)) { 
			//sanitize input fields;
			$cr = new crypto();
			$password_hash  = $cr->one_way_crypt($password);

			//add new user to database
			$u = new user();
			try { 
				if($u->create_user( $username, $password_hash, $email) )
				{			
					$uid = $u->get_user_id($email);
					$token = base64_encode($cr->encrypt($uid));
					//send activation email				
					$link = "http://punbt090pc/activate.php?u=" . urlencode($token); 				
					include_once("/var/www/includes/email.php");
					send_activation_email($email, $link);
					set_registration_error("An activation email has been sent to your inbox (Please check your junkbox in case you have not received it).");
				}
				else { 
					//send back to registration page
					header("Location: /register.php");
				}
			}catch(Exception $e) { 
				set_registration_error("UserName Or Email is already registered");	
			}
		}else {
			set_registration_error("Invalid Captcha");
		}
	}

	function activate_user() { 
		$activated = false;
		$token = $_GET['activate'];	
		if($token != '') { 
			$cr = new crypto();
			$uid = $cr->decrypt(base64_decode(urldecode($token)));
				$u = new user();
				if($u->activate_user($uid)	)
				{
					$activated = true;
				}
		}
		return $activated;
	}
	//----------------------------------------------------------------------
	// global invocation as part of login submission or logout
	//----------------------------------------------------------------------
	if(isSet($_POST["login_submitted"]))
	{	
		authenticate();
	}
	elseif(isSet($_GET["logout"]))	{		logout();	}
	elseif(isSet($_POST["register_submitted"])) { register_user(); }
	elseif(isSet($_GET["activate"])) { activate_user(); } 
	else { 
		if($_SERVER['REQUEST_URI'] == '/index.php') {
			if(isSet($_COOKIE['app_session_id']))
				header('Location: /challenges.php');
		}
	 } 

?>
