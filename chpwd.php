<!DOCTYPE HTML>
<html>
<?php
	$msg = ""; 
	if(isSet($_POST['chpwd_submitted'])) { 
		$old_pwd = $_POST['old_password'];
		$new_pwd = $_POST['new_password'];
		$con_pwd = $_POST['confirm_password'];

		if($old_pwd === "" || $new_pwd === '' || $con_pwd === '') { 
			$msg = "None of the field should be empty";
		}
		else {
			if($new_pwd != $con_pwd) { 
				$msg = "New and confirm password are mismatch";
			}
			elseif (isSet($_COOKIE['app_session_id']) && $_COOKIE['app_session_id'] != '') { 
			try {
				include_once("/var/www/includes/user.php");
				include_once("/var/www/includes/session.php");
				include_once("/var/www/includes/crypt.php");

				$cr =  new crypto();
				$password = $cr->one_way_crypt($new_pwd);
				$old_pwd  = $cr->one_way_crypt($old_pwd);
	
				$cookie_token = $_COOKIE['app_session_id'];

				$s = new user_session();
				if($s->decode_session($cookie_token)) { 
					$u = new user();
					if(!$u->update_password($s->get_uid(), $old_pwd, $password))
						throw new Exception("Password Mismacth: Try Again");
					$msg = "Password Updated Successfully";
				}else {
					$msg = "Session Expired";
				}
			}catch(Exception $e) { 
				$msg = $e->getMesage();
			}
		}else { 
					$msg = "Session Expired";
		}	
	   }
		//header('Location: ' . $_SERVER['REQUEST_URI']);
	}
?>

<?php include("head.inc"); ?> 

<body>
<?php include("bg.inc"); ?> 

    <div id="main">

        <?php include("header.inc"); ?> 

        <div id="site_content">
            <?php include("sidebar_menu.inc"); ?> 
				<div class="content">
            <p> <font color="green">
				<?php if($msg != "") { echo $msg; } else  { ?>
				&nbsp;
				<?php } ?> </font>
			</p>
        	<form id="chpwd" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form_settings">
			<h3><font color="green">Change Password</font></h3>
            <p><span>Old Password </span><input class="contact" type="password" name="old_password" value="" /></p>
            <p><span>New Password </span><input class="contact" type="password" name="new_password" value="" /></p>
            <p><span>Confirm Password </span><input class="contact" type="password" name="confirm_password" value="" /></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" onsubmit="return check_form();" type="submit" name="chpwd_submitted" value="send" /></p>
          </div>
        </form>
      			</div>
    		</div>
        </div>
        
	    <div id="scroll">
	        <a title="Scroll to the top" class="top" href="#"><img src="images/top.png" alt="top" /></a>
	    </div>
	        
	    <?php include("footer.inc"); ?> 
	    
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
	        
