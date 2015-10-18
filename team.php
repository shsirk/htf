<!DOCTYPE HTML>
<html>

<?php include("head.inc"); ?> 

<body>
<?php include("bg.inc"); ?> 

    <div id="main">
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
		<div id="menu_container">
		        <h1><center>Team <font color=red">#hackTheFlag</font></center></h1>
		</div>
	  </nav>
	</header>
        <div id="site_content">
            <?php include("common_sidebar.php"); ?> 
			<div class="content">
				<div id="imgContainer">				
					<img src="images/background.jpg" width="160" height="160" />
					<br/><center>Krishs	</center>
				</div>
				<div id="imgContainer">				
					<img src="images/background.jpg" width="160" height="160" />
					<br/><center>Mridulesh	</center>
				</div>
				<div id="imgContainer">				
					<img src="images/background.jpg" width="160" height="160" />
					<br/><center>Sameer	</center>
				</div>
				<div id="imgContainer">				
					<img src="images/background.jpg" width="160" height="160" />
					<br/><center>Mayank	</center>
				</div>
				<div id="imgContainer">				
					<img src="images/background.jpg" width="160" height="160" />
					<br/><center>Tony</center>
				</div>
				<div id="imgContainer">				
					<img src="images/background.jpg" width="160" height="160" />
					<br/><center>Rohit	</center>
				</div>
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
	        
