<?php
	include_once("/var/www/includes/captch_code.php");
	//session_start();

	$code = get_code();

	//_$SESSION['CAPTCHA_CODE'] = $code; 

	$im = imagecreatetruecolor(50,24);
	$bg = imagecolorallocate($im, 22,86,165);
	$fg = imagecolorallocate($im, 255,255,255);
	imagefill($im,0,0,$bg);
	imagestring($im,5,5,5,$code,$fg);
	header("Cache-Control: no-cache, must-revalidate");
	header("Content-type: image/png");
	imagepng($im);
	imagedestroy($im);
?>
