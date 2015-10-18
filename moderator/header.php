<?php
	include_once("includes/auth.php");
?>

<header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">HackWeek<span class="logo_colour">#hackTheFlag</span></a></h1>
          <h2>Hack like ninja, play for proud, fun and profit!</h2>
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
		<?php if($session->get_uname() == 'krishs') { ?>
            <li><a href="#">Moderator</a>
              <ul>
                <li><a href="/controlpanel.php?view=list_users">View Users</a></li>
                <li><a href="#">Puzzles</a>
                  <ul>
                    <li><a href="/controlpanel?view=new_puzzle">New Puzzle</a></li>
                    <li><a href="/controlpanel?view=view_puzzle">View Puzzles</a></li>
                  </ul>
                </li>
                <li><a href="#">Categories</a>
		  <ul>
		     <li><a href="/controlpanel?view=new_category">New Category</a></li>
		     <li><a href="/controlpane?view=show_categories">View Categories</a></li>
		  </ul>
		</li>
              </ul>
            </li>
		<?php  } ?>
	    <li><a href="/logout.php?logout=1">LogOut</a></li>
          </ul>
        </div>
<?php } } ?>
      </nav>
    </header>
