<?php
	include_once("includes/auth.php");
?>

<header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">HackWeek<span class="logo_colour">#hackTheFlag</span></a></h1>
          <h2>Hack like ninja!, play for pride, fun and prizes!</h2>
        </div>
      </div>
      <nav>
<?php
    if(isSet($_COOKIE['app_session_id']))
    {
		$session = new user_session();
		if($session->decode_session($_COOKIE['app_session_id']))
		{
?>
        <div id="menu_container">
          <ul class="sf-menu" id="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="/scoreboard.php">ScoreBoard</a></li>
  	 
            <li><a href="/chpwd.php">Change Password</a></li>
	    <li><a href="/logout.php?logout=1">LogOut</a></li>
          </ul>
        </div>
<?php } } ?>
      </nav>
    </header>
