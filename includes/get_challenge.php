
<div class="content">
<?php

$err_msg = "";

if(isSET($_POST['submitted'])) { 
	$qid = intval($_POST['q']);
	$flag = trim($_POST['answer']);
	$flag  = strtolower($flag);

	if($qid <=0 || $qid >= 65535) { 
		header("Location: /challenges.php");
	}

	include_once("includes/session.php");
	$u = new user_session();
	if(!$u->get_user_session()) { 
		header('Location: /index.php');
	} else { 
		include_once("includes/game.php");
		$g = new game();
		try { 
			if($g->verify_flag($u->get_uid(), 0 , $qid , $flag)) { 
				$_SESSION['WELL_DONE'] = "Congrats!!! You seems to be pro. Check out Other puzzles :-)";
			} else {  
				$_SESSION['WELL_DONE'] = "Bad Luck. Try Again";
			}	 
		}catch(Exception $e) { 
				$_SESSION['WELL_DONE'] = $e->getMessage();
		}
		header('Location: /question?q=' . $qid);
	}
}
elseif(!isSet($_GET['q']))
	include_once("content.inc");
else {
		$qid = intval($_GET['q']); 
		if($qid <=0 || $qid >= 65535) { 
			header("Location: /challenges.php");
		}
		include_once("includes/puzzle.php");
		$qObj = new question();
		$result = $qObj->get_question_details($qid);
		if(count($result) != 0) { 
?>
<?php
	if(isSet($_SESSION['WELL_DONE']) && $_SESSION['WELL_DONE'] != "") { 
?>
	<h2><font color="green"><?php echo $_SESSION['WELL_DONE']; $_SESSION['WELL_DONE']=""; ?></font></h2>
<?php	} else { ?>
	<p>&nbsp;</p>
<?php } ?>
	<?php $qObj = $result[0]; ?>
	<h1> <font color="green"> <?php echo $qObj->get_qtag();  ?> </font> </h1>
	<p> <?php echo $qObj->get_qname();  ?> </p>
	<p style="font-size: 70%; color: red">Hint: <?php echo $qObj->get_hint();  ?> </p>

	<?php 
		$u = new user_session();
		if(!$u->get_user_session()) { 
			header('Location: /index.php');
		} else {
			include_once("includes/game.php");
			$g = new game() ; 
			if(!$g->solved_already($u->get_uid(), $qid)) { 
	?>
		<form id="challenge" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    	      <div class="form_settings">
        	    <p><font color="red"><?php echo $err_msg; ?></font></p>
            	<p><span> Got the Answer!!! </span><input class="contact" type="text" name="answer" value="" /> 
                	<input type="hidden" name="q" value="<?php echo $qid; ?>" /></p>
            	<p style="padding-top: 15px"><input class="submit" type="submit" name="submitted" value="Submit!" /></p>
          	</div>
		</form>
	<?php }else { ?>
		<h3> <font color="green"> Aha, you have already solved it! </font></h3>	
	<?php } } ?>
	
<?php } else {  ?>
	
		<h3> <font color="red"> <center> Question does not exist </center></font></h3>	
<?php  }}   ?>
</div>
