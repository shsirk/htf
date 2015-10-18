<!DOCTYPE HTML>
<html>

<?php include("head.inc"); ?> 

<body>
<?php include("bg.inc"); ?> 

    <div id="main">

        <?php include("header.inc"); ?> 

        <div id="site_content">
	<?php if(isSet($_COOKIE['app_session_id']) && $_COOKIE["app_session_id"] != "") { 
				include("sidebar_menu.inc");
		  }else { 
             include("common_sidebar.php");  
		   }
				$user_id = 0;
				$user_name = "";
				if(isSet($_COOKIE['app_session_id']) && $_COOKIE['app_session_id'] != '') { 
					include_once("/var/www/includes/session.php");
					$s = new user_session();
					if($s->decode_session($_COOKIE['app_session_id'])) { 
						$user_name = $s->get_uname();
						$user_id = $s->get_uid();
					}
				}			
				include_once("/var/www/includes/game.php");
			?>
		   <div class="content">
			<h3><font color="red">Scoreboard has been modified to remove discrepancies due to flag sharing</font></h3>
			<?php
				if($user_id != 0) { 
					$my_g = new game();
					$my_result = $my_g->get_my_scoreboard($user_id);
					if(count($my_result) != 0) { 
			?>
				<table width="80%">
					<tr>
						<th width="25%">Category</th>
						<th>Question</th>
						<th width="20%">Points</th>
					</tr>
			<?php
						foreach($my_result as $out) {
			?>
				<tr>
					<td> <?php echo $out->get_category(); ?></td>
					<td> <?php echo $out->get_question(); ?></td>
					<td> <?php echo $out->get_score(); ?></td>
				</tr>
			<?php } } ?>
				</table>
			<?php
				} ?>

			<table width="80%" style="border: 1px">
			  <tr>
				<th width="10%"><h3>No</h3></th>
				<th width="20%"><h3>User</h3></th>
				<th><h3>Email</h3></th>
				<th width="20%"><h3>Score</h3></th>
			  </tr>
			<?php

				$counter = 1;
				$g = new game();
				$result = $g->get_scoreboard();
				foreach($result as $output)
		        {
					if($output->get_user() === $user_name) { 
			?>
			  <tr style="background: green">
				<?php } else { ?>
				<tr>
				<?php } ?>
				<td><?php echo $counter; ?></td>
				<td><?php echo $output->get_user(); ?></td>
				<td><?php echo $output->get_email(); ?></td>
				<td><?php echo $output->get_score(); ?></td>
			  </tr>
            <?php $counter = $counter + 1; } ?> 
		
			</table>
		  </div>
	     </div>
        </div>
       <!-- 
	    <div id="scroll">
	        <a title="Scroll to the top" class="top" href="#"><img src="images/top.png" alt="top" /></a>
	    </div>
	   -->     
	    <?php /*include("footer.inc");*/ ?> 
	    
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
	        
