
<div class="content">
<?php

if(!isSet($_GET['c']))
{
	include_once("content.inc");
}
else {
	$chid = intval($_GET['c']); 

	if($chid > 0 && $chid < 65535)
    {
		include_once("db/mysql_crud.php");

		$db = new Database();
    	$db->connect();

		$query = "SELECT q_id, q_tag, q_points FROM questions WHERE c_id=" . $chid; 
    	$db->sql($query);
    	$result = $db->getResult();

		$db->disconnect(); 
	
		if(count($result) > 0) { 
?>
<table width="80%">
	<tr>
		<th width="10%"><h3>No.</h3></th>
		<th ><h3>Puzzle</h3></th>
		<th width="10%"><h3>Points</h3></th>
	</tr>
	<?php
		$counter = 1;
		foreach($result as $output) 
		{ 
		   $q_id = $output["q_id"];
	?>
	<tr>
		<td><?php echo $counter; ?></td>	
		<td><a href=/question?q=<?php echo $output['q_id']; ?>><?php echo $output["q_tag"]; ?></a></td>	
		<td><?php echo $output["q_points"]; ?></td>	
	</tr>		
	<?php 
		$counter = $counter + 1; 
		}
	?>
</table>
<?php 
  }else { 
		echo('<h3> <font color="red"> <center> Please select proper category </center></font></h3>	');
	}
 }else { 
		//header('Location: /challenges.php');
		echo('<h3> <font color="red"> <center> Please select proper category </center></font></h3>	');
	}
}
?>

</div>
