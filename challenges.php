<!DOCTYPE HTML>
<html>

<?php include("head.inc"); ?> 

<body>
<?php include("bg.inc"); ?> 

    <div id="main">

        <?php include("header.inc"); ?> 

        <div id="site_content">
            <?php include("sidebar_menu.inc"); ?> 
            <?php 
		include_once("includes/get_challenge_list.php"); 
	    ?> 
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
	        
