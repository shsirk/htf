<?php

	include("/var/www/includes/game.php");

	$g = new game();
	if($g->solved_already(2,2))
	{
		echo "you have sovled this question before";
	}
	else {	
		echo "points updated successfully";
	}


	$score = $g->get_user_score(5);
	echo $score;

	echo "<br/>";

	$points = $g->get_points_of_flag(4,3,'malwarex');
	echo $points;
?>
