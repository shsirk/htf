<html><head></head><body>
<?
	include("includes/user.php");

	$u = new user();
	
	$u->set_user_information(101, 'sammy', 'sammy@email.com', 1);
	echo $u->get_uid() . '<BR/>';	
	echo $u->get_uname() . '<BR/>';	
	echo $u->get_email() . '<BR/>';	
	echo $u->is_active() . '<BR/>';	
	
	echo "creating user <BR/>";	
	if($u->create_user(101, 'sammy', 'hacking', 'sammy@email.com' , 0) == 1)
		echo "user create successfully" . "<BR/>";
	else
		echo "error while creating user" . "<BR/>";

	$u->activate_user(101);		
	$u->update_password(101, 'newpass');

?>
</body></html>
