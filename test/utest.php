<html><head></head><body>
<?
	include("/var/www/includes/user.php");

	$u = new user();
	$m = 13;
 $t =  $u->already_activated(	$m);
	echo "activated" . $t;
?>
</body></html>
