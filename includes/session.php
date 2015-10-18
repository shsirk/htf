<?php

include_once("/var/www/includes/crypt.php");

class user_session { 
	
	private $session_uid = 0; 
	private $session_uname = "";
	private $session_email = "";

	public function create_session_id($uid, $uname, $email) {
		$this->session_uid = $uid ;
		$this->session_uname = $uname; 
		$this->session_email = $email;
		
		$session_id = ($this->session_uid . '&' . $this->session_uname . '&' . $this->session_email);

		$cr = new crypto();
		return (base64_encode($cr->encrypt($session_id)));
	}

	public function decode_session($session_id) { 
		$cr = new crypto();
		$usr_session = $cr->decrypt(base64_decode($session_id));

		$tokens = split('&', $usr_session);
		if(count($tokens) != 3) {return false;	}

		$this->session_uid = $tokens[0];
		$this->session_uname = $tokens[1];
		$this->session_email = $tokens[2];

		return true;
	}

	public function set_user_session() { 
		//setcookie('app_session_id' , $this->create_session_id(
	} 
	public function clear_user_session() { 
		setcookie('app_session_id');
	} 

	public function get_user_session() { 
		if(!isSet($_COOKIE['app_session_id']))
			return false;
		return $this->decode_session($_COOKIE['app_session_id']);
	} 

	public function get_uid() { return $this->session_uid; } 
	public function get_uname() { return $this->session_uname; } 
	public function get_email() { return $this->session_email; }
}

?>
