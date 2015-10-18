<!DOCTYPE HTML>
<html>

<head>
  <title>#hackTheFlag</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="/css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="/js/modernizr-1.5.min.js"></script>
</head>

 

<body>
<div id="bg">
    <img src="/images/background.jpg" alt="home">
</div>
 

    <div id="main">

        
<header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">HackWeek<span class="logo_colour">#hackTheFlag</span></a></h1>
          <h2>Hack like ninja, play for proud, fun and profit!</h2>
        </div>
      </div>
      <nav>
      </nav>
    </header>
	
	<?php
		$msg = false;
		$err = "";
		$linktoken = "";

		if(isSet($_GET['u'])) { 
			include_once("/var/www/includes/crypt.php");
			include_once("/var/www/includes/user.php");

			$token = urldecode($_GET['u']); 
			if($token != "") {
				$u = new user();
				$cr = new crypto();
				$uid = $cr->decrypt(base64_decode(urldecode($token)));
				try { 
					if($u->already_activated($uid)) { 
						throw new Exception("User is already activated");
					}else {
						if($u->activate_user($uid)) { 
							$msg = true;
						}else throw new Exception("Activatation failed!!!");
					}
				}catch(Exception $e) {
					$err = $e->getMessage();
				}
			}		
		}elseif(isSet($_GET['linktoken'])) {	
			$linktoken = $_GET['linktoken'];
		} else { 
		}
	?> 

        <div id="site_content">
             
			<div class="content">
			 <?php if($msg) { ?>
				<h1>Activation Completed!!!</h1> log in here <a href="/index.php">/index.php</a>
			<?php } else { ?>
				<h1><?php echo $err; ?></h1> contact moderator <a href="mailto:krishnakant.patil@siemens.com">mail me</a>
			<?php } ?>

			<?php if($linktoken != "") { ?>
				<p>click here to activate user <a href="/activate.php?u=<?php echo $linktoken; ?>">activate me</a></p>
			<?php } ?>
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
	        
