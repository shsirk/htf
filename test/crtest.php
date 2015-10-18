<?php

	include("/var/www/includes/crypt.php");

	$c = new crypto();

	$a = 'abc123';
	echo $a;
	echo "<BR/>";
	echo $c->one_way_crypt($a);

	echo "<BR/>";

	$u = $_GET['u'];
	$token = urldecode($u);
	echo $token;
	echo "<BR/>";
	$t = base64_decode($token);
	echo $t;
	echo "<BR/>";

	echo $c->decrypt($t);
?>
