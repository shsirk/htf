<?php

$mysql_user = "root";
$mysql_pass = "123456";
$mysql_host = "localhost";
$db_name = "hacktheflag";

function mysql_connect_db()
{
	$dbhandle = mysql_connect($mysql_host, $mysql_user, $mysql_pass)
		or die("database is down at the moment, please try again later");	

	$selected_db = mysql_select_db($db_name, $dbhandle)
		or die("no database to select");

	return $dbhandle;
}

function mysql_close_connection($dbhandle)
{
	mysql_close($dbhandle);
}

function mysql_execute_query($dbhandle, $query)
{
	$result = mysql_query($query);
	return $result;	
}

?>
