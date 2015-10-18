<html><body>
<?php
	error_reporting(E_ALL);
	include_once("/var/www/includes/puzzles.php");

function list_all() { 

	$c = new category();
	$all = $c->get_all_categories();
	foreach($all as $cc) { 
		echo $cc->get_cname() . "<BR/>";
	}
} 

$c = new category();
$c->remove_category(101 );
list_all();

?>
</body></html>
