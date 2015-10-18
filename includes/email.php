<?php
#configure the SMTP and sendmail_from in Php.ini

	function send_activation_email($to, $link) { 
		$body = "Welcome to Hack Club!!! We are happy to announce Siemens Pune's first ever Hackathon. Click on link to activate yourself " . $link;
		send_mail($to, "#hackTheFlag account activation" , $body);
	} 
	
	function send_reset_email($to, $link) {
		$body = "Click/or paste link in browser address bar - " . $link;
		send_mail($to, "#hackTheFlag password reset", $body);
	}

	function send_mail(
		$to, $subject, $body) { 
		$headers = "From: krishnakant.patil@siemens.com\r\n";
		$mail_send = mail($to, $subject, $body, $headers);
	}
?>
