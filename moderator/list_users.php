
<div class="content">
<?php
	include_once("db/mysql_crud.php");
	
	$db = new Database();
	$db->connect();
	$db->sql("SELECT u_id, u_name, u_email, u_active FROM users");
	$result = $db->getResult();
?>
<table width="100%">
	<tr>
		<th width="10%"><h4>SrNo.</h4></th> 
		<th width="30%"><h4>User</h4></th>
		<th width="50%"><h4>Email</h4></th>
		<th width="10%"><h4>Active</h4></th>
	</tr>
	<?php
		$counter = 1; 
		foreach($result as $output) 
		{
	?>
	<tr>
		<td><?php echo $counter; ?></td>
		<td><?php echo $output["u_name"]; ?></td>
		<td><?php echo $output["u_email"]; ?></td>
		<td><?php echo $output["u_active"]; ?></td>
		
		<?php $counter = $counter + 1; ?>
	</tr>		
<?php 
		} 
	$db->disconnect();
?>
</table>

</div>
