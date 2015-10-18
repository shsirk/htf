<!DOCTYPE HTML>
<html>
<?php
	if(isSet($_POST["login_submitted"]))
	{
		include_once("includes/auth.php");
	}
?>

<?php include("head.inc"); ?> 

<body>
<?php include("bg.inc"); ?> 

    <div id="main">

        <header>
          <div id="logo">
            <div id="logo_text">
              <!-- class="logo_colour", allows you to change the colour of the text -->
              <h1><a href="/index.php">HackWeek<span class="logo_colour">#hackTheFlag</span></a></h1>
              <h2>Hack like ninja, play for proud, fun and profit!</h2>
            </div>
          </div>
      
      <nav>
      </nav>
    </header>


        <div id="site_content">
            <?php include("common_sidebar.php"); ?> 

           <?php 
				$msg = ""; 
				$success = false;

				if(isSet($_POST['reset_submitted']))
				{
					include_once("/var/www/includes/validation.php");
					$email = trim($_POST['email']);
					if($email != "") { //is_email_valid($email)) { 
						include_once("/var/www/includes/user.php");
						include_once("/var/www/includes/crypt.php");
						$u = new user();
						$uid = $u->get_user_id($email);
						if($uid != 0) { 
							$cr = new crypto();
							$token = base64_encode($cr->encrypt($uid));
							$link  = 'http://punbt090pc/reset.php?token=' . urlencode($token) ;
							include_once("/var/www/includes/email.php");
							send_reset_email($email, $link);
							$msg = "Reset instruction are sent to email - " . $email . " Please check inbox/junkbox."; 
							$success = true;
						}else {
							$msg = "Email is not registered";
						}
					} else {
						$msg = "Invalid Email " . $email;
					}
				}
				elseif(isSet($_POST['resetpwd_submitted'])) { 
					$token = $_POST['token'];
					$new_pwd =  trim($_POST['new_password']);
					$con_pwd = trim($_POST['con_password']);
					if($new_pwd == "" || $con_pwd == "") {
						$msg = "No blank fields allowed";
					}elseif($new_pwd != $con_pwd) { 
						$msg = "Password Mismatch";
					}else {
						include_once("/var/www/includes/user.php");
						include_once("/var/www/includes/crypt.php");

						$cr = new crypto();
						$u  = new user();

						$uid = urldecode($cr->decrypt(base64_decode($token)));
						$uid = intval($uid);
			
						if($uid != 0) { 
							if($u->update_password($uid, NULL , $cr->one_way_crypt($new_pwd))) { 
								$msg = "Password changed successfully";
								$success = true;
							}else {
								$msg = "Error while changing password";
							}
						}else {
							$msg = "Something goes wrong while resetting password. Contact Team";
						}
					}
				}
			?>

<div class="content">
    <h1>Reset Password</h1>
	<?php
		if (!isSet($_GET['token'])) { 
	?>
        <form id="login" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form_settings">
            <p><span>Email</span><input class="contact" id="u_name" type="text" onclick="u_on_click" name="email" value="" /></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" onsubmit="return check_form();" type="submit" name="reset_submitted" value="send" /></p>
			<h3>
				<?php if($success) { ?> 
					<font color="green"><?php echo $msg; ?>
				<?php }else { ?>
					<font color="red"><?php echo $msg; ?>
				<?php } ?>
					</font></h3>
          </div>
        </form>
	<?php }
		else {
			$token = trim($_GET['token']);
			if($token != "") { 
	?>
        <form id="reset_pwd" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form_settings">
            <p><span>New Password</span><input class="contact" id="new_password" type="password" name="new_password" value="" /></p>
            <p><span>Confirm Password</span><input class="contact" id="con_password" type="password" name="con_password" value="" /></p>
            <input class="contact" id="token" type="hidden" name="token" value="<?php echo $token ?>" /></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit"  type="submit" name="resetpwd_submitted" value="send" /></p>
			<h3><font color="green"><?php echo $msg; ?></font></h3>
          </div>
	<?php } }?>
      </div>
    </div>
        </div>
        
	    
    </div>     

<!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
      $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
    });
  </script>
</body>
</html>	   
	        
