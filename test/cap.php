<?php

	$a = rand(1, 9);
	$b = rand(1, 9);

	$c = substr(md5($a + $b), 5, 10);

	echo $c;
?>
