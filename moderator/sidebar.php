<?php
	if(isSet($_COOKIE['app_session_id']) && $_COOKIE["app_session_id"] != "") 
    {
?>

<div id="sidebar_container">
        <div class="sidebar">
          <h3>Tip Of Hack</h3>
          <h4>Clue on puzzle shall appear here</h4>
          <h5></h5>
          <p>Refrain yourself from any malparactice such as sharing of flag. Play like king! <a href="/readme.php">Read more</a></p>
        </div>
        <div class="sidebar">


          <h3>Challenges</h3>
          <ul>
			<li><a href="">Users</a></li>
			<li><a href="">Category</a></li>
			<li><a href="">Questions</a></li>
          </ul>

        </div>
      </div>

<?php } ?>
