<?php

function get_code()
  {
		session_start();
		$code = rand(1000,9999);
		$_SESSION['CAP_CODE'] = $code;
		return $code;
	}

function check_code($code)
  {
		if($_SESSION['CAP_CODE'] == $code)
			return true;
		return false;
	}
	
?>
