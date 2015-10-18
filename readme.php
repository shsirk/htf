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
          <h2>Hack like ninja!, play for pride, fun and prizes!</h2>
        </div>
      </div>
      <nav>
      </nav>
    </header>
	
        <div id="site_content">
	<?php if(isSet($_COOKIE['app_session_id']) && $_COOKIE["app_session_id"] != "") { 
				include("sidebar_menu.inc");
		  }else { 
             include("common_sidebar.php");  
		   }
	?>
			<div class="content">
				<h1><font color="green">Welcome to #hackTheFlag! </font></h1>
				<p>
#hackTheFlag is a competition in line with the popular, "Capture the Flag". A user can play as an individual or as a team, in order to capture the "flag". Influenced by the game show "Jeopardy", a user is required to solve puzzles, which are categorized in sections of varying difficulty.
				<p><font color="red"> Rules</font> </p>
				  <ul>
						<li>Players are required to create an account in order to participate in the challenge (Registration link will open on 9th March 2015) </li>
	<li>A team must participate through a single user account </li>
	<li>The first 5 participants to complete all levels OR have maximum points on 11th March 2015 at 8.00 PM shall be declared as the winners </li>
	<li>The winners shall be awarded prizes</li>
	<li>#hackTheFlag is scheduled to start on 9th March 2015 and end on 11th March 2015 </li>
	<li>If you are playing as a team, please note that if your team is among the top 5, you will be required to nominate one person from your team to collect the prizes. </li>
	<li>Running Automation tools (brute forcing tools) are strictly prohibited and will not help you complete the challenge in any way.</li>
				 </ul>	
				</p>
	<p>
	You can contact the following people for any concerns or queries:</p>
		<ul>
			<li>krishnakant.patil@siemens.com </li>
		<li>sameer.deshmukh@siemens.com </li>
		<li>mayankravi.kulkarni@siemens.com </li>
		</ul>
				<p>
				<?php if(!isSet($_COOKIE['app_session_id']) || $_COOKIE["app_session_id"] == "") {
				 ?>
					<h3>Login <a href="/index.php">Here</a> Or see where are others <a href="/scoreboard.php">Scoreboard</a></h3>
				<?php } ?>
				</p>
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
	        
