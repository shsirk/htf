
<div class="content">
<?php
    if(isSet($_POST["submitted"))
    {
/*	include_once("db/mysql_crud.php");
	
	$db = new Database();
	$db->connect();
	$db->sql("SELECT u_id, u_name, u_email, u_active FROM users");
	$result = $db->getResult();
	$db->disconnect();
*/  
  }
?>
	<form id="login" action="<?php $_SERVER[PHP_SELF]; ?>" method="post">
          <div class="form_settings">
            
            <p><span>Category</span>
		<input class="contact" type="choice" name="category" value="">
		
	    </p>
            <p><span>Question</span><input class="contact" type="text" name="question" value="" /></p>
            <p><span>Hint</span><input class="contact" type="text" name="hint" value="" /></p>
            <p><span>Points</span><input class="contact" type="text" name="points" value="" /></p>
            <p><span>Flag</span><input class="contact" type="text" name="flag" value="" /></p>
            <p>&nbsp;</p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="submitted" value="send" /></p>
          </div>
        </form>

<?php 
?>
</table>

</div>
