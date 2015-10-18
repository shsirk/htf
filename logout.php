<!DOCTYPE HTML>
<html>
<?php
	setcookie('app_session_id');
	if(isSet($_GET['logout']))
		header('Location: /logout.php');
?>
<?php include("head.inc"); ?> 

<body>
<?php include("bg.inc"); ?> 

    <div id="main">

        <?php include("header.inc"); ?> 

        <div id="site_content">
			<div class="content">
		<h1>Thanks for playing #hackTheFlag</h1>
			<p><a href="/index.php">Login</a> to continue playing or
			<a href="/scoreboard.php">Scoreboard</a> to view scoreboard</p>
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
	        
