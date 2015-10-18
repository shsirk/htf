
<?php include("mysql_connect.php");

	$result = mysql_query("select * from users")
		or die("could not get rows");

	while($row = mysql_fetch_array($result))
	{
		echo $row{'id'};
	}

   include("mysql_disconnect.php");
?>
