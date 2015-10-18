<?php

$mysql_user = "root";
$mysql_pass = "123456";
$mysql_host = "localhost";
$db_name = "hacktheflag";

$dbhandle = mysql_connect($mysql_host, $mysql_user, $mysql_pass)
	or die("database is down at the moment, please try again later");	

$selected_db = mysql_select_db($db_name, $dbhandle)
	or die("no database to select");
?>
