
</script>
<div class="content">
    <h1>Sign In / <a href="register.php">Register Now</a></h1>
        <form id="login" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form_settings">
            <p>
					<span>UserName</span>
					<input class="contact" id="username" type="text" name="username" value="" />
			</p>
            <p><span>Password <a href="/reset.php" style="font-size: 70%">Reset Password?</a></span><input class="contact" id="password" type="password" name="password" value="" /></p>
			<p>&nbsp;</P>
            <p style="line-height: 1.7em;">Captcha!!!</p>
            <p><span><img src="/includes/captcha.php"></span><input type="text" name="captcha" id="captcha" /></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" id="submit" type="submit" name="login_submitted" value="send" /></p>
          </div>
        </form>
      </div>
    </div>
