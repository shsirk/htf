<?php
	if(isSet($_COOKIE['app_session_id']) && $_COOKIE["app_session_id"] != "") 
    {
?>

<div id="sidebar_container">
        <div class="sidebar">
          <h3>Tip Of Hack</h3>
          <h4>Take a closer look at the hint given in each question :)</h4>
          <h5></h5>
          <p>Refrain from any malpractices such as sharing of flag.</p>
        </div>
        <div class="sidebar">

<?php 
   include("db/mysql_connect.php");

   $result = mysql_query("select c_id,c_name from categories")
                or die("could not get rows");

   include("db/mysql_disconnect.php");
?>

          <h3>Challenges</h3>
          <ul>
<?php
        while($row = mysql_fetch_array($result))
        {
?>
            <li><a href="/challenges.php?c=<?php echo $row{'c_id'}; ?>"><?php echo $row{'c_name'}; ?></a></li>
<?php
	}
?>
          </ul>

        </div>
      </div>

<?php } ?>
