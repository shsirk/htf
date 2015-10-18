<html>
	<head>hey</head>
<body>
<?php

if(0) { 
	echo "connectign db";
		
	$con = new mysqli("localhost" "root", "123456", "dvwa");
	if($con->connect_error)
		die("connection failed\n");
	
	echo "connected to db successfully";

	$result = mysqli_query("select * from users");
	if($result) 
	{ 
		echo "<table>" ;
		while($row = mysqli_fetch_assoc($result))
		{
			echo "<tr>";
			echo "<td>";
				echo $row[0];
			echo "</td>";

			echo "<td>" ;
				echo $row[1];
			echo "</td>";

			echo "</tr>";	
		}
		echo "</table>";		
			
	}

	$con->close();
}
else {
	echo "Hello";
}
?>
	<h1>hey</h1>

</bodY>
</html>
