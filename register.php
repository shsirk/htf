<!DOCTYPE HTML>
<?php
	if(isSet($_POST["register_submitted"]))
		include_once("includes/auth.php");
?>

<html>

<?php include("head.inc"); ?> 

<body>
<?php include("bg.inc"); ?> 

    <div id="main">

        <header>
          <div id="logo">
            <div id="logo_text">
              <!-- class="logo_colour", allows you to change the colour of the text -->
              <h1><a href="index.php">HackWeek<span class="logo_colour">#hackTheFlag</span></a></h1>
              <h2>Hack like ninja!, play for pride, fun and prizes!</h2>
            </div>
          </div>
      
	 <nav>
		<?php
		include_once("/var/www/includes/error.php");	
		$msg = get_registration_error();
		if($msg != '') { 
			set_registration_error("");
		?>
			<div id="menu_container">
				<center><h3 id="err_msg" style="color: red"><?php echo $msg; ?></h3></center>
			</div>
		<?php } else { ?>
			<div id="menu_container">
				<center><h3 id="err_msg" style="color: red"></h3></center>
			</div>
		<?php } ?>
      </nav>
    </header>


        <div id="site_content">
            <?php include("common_sidebar.php"); ?> 

            <?php include("includes/register_content.php"); ?> 

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

	$(".submit").click(function() { 
		var uname = $("#username").val();
		var pass = $("#password").val();
		var email = $("#email").val();
		var captcha = $("#captcha").val();	

		if(uname.length == 0 || pass.length ==0 || email.length ==0 || captcha.length == 0)	{
			document.getElementById("err_msg").innerHTML = "You cannot leave fields blank";
			return false;
		}
		 if(uname.length > 20) { 
			document.getElementById("err_msg").innerHTML = "User name should not exceeed 20 characters";
			return false;
		}
		 if(email.slice(-12) != "@siemens.com") { 
			document.getElementById("err_msg").innerHTML = "Need your official email ID e.g abc@siemens.com";
			return false;
		}

		return true;
	});
  </script>
</body>
</html>	   
	        
