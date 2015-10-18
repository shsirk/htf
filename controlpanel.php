<!DOCTYPE HTML>
<html>

<?php include("head.inc"); ?> 

<body>
<?php include("bg.inc"); ?> 

    <div id="main">

        <?php include("moderator/header.php"); ?> 

        <div id="site_content">
            <?php include("moderator/sidebar.php"); ?> 
            <?php 
			if(isSet($_GET['view'])) { 
				$view = $_GET['view'];
				if($view === 'u')
					{ include("moderator/list_users.php"); } 
				elseif($view === 'c')
					{ include("moderator/category.php"); }
				elseif($view === 'q')
					{ include("moderator/question.php"); }
				else
					{ include("content.inc"); }
			}
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
	        
