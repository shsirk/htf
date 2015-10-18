<?php
	
	$e = "2Xe41PNx4WY=";
	echo urldecode($e);
	echo "<BR/>";
	$c=  base64_decode($e);

	include_once("/var/www/includes/crypt.php");
	$cr = new crypto();
	$uid= $cr->decrypt($c);

	include_once("/var/www/includes/user.php");
	$u = new user();
	$u->activate_user($uid);

?>
