<div class="content">
	<?php
	include_once("/var/www/includes/error.php");
	$u_value = "value=\"\"";
	$msg = get_registration_error();
	if($msg != '') { 
		$u_value = "style=\"background: red \" value=\"" . $msg . "\"";
		clear_registration_error();
	}
	?>
	<?php if($msg != "") { ?><p><?php echo $msg; ?></p> <?php } ?>
    <h1><a href="index.php">Sign In</a> / Register Now</h1>
        <form id="register" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form_settings">
            
            <p><span>UserName</span><input class="contact" type="text" id="username" name="username" value="" /></p>
            <p><span>Password</span><input class="contact" type="password" id="password" name="password" value="" /></p>
            <p><span>Official Email</span><input class="contact" type="text" name="email" id="email" value="" /></p>
            <p>&nbsp;</p>
            <p style="line-height: 1.7em;">Captcha!!!</p>
            <p><span><img src="/includes/captcha.php"/></span><input type="text" name="captcha" id="captcha"/>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" id="submit" type="submit" name="register_submitted" value="send" /></p>
			<p>&nbsp;</p>
			<p>Contact <a href="mailto:krishnakant.patil@siemens.com">hackteam</a> in case of registration problem</p>
          </div>
        </form>
      </div>
    </div>
