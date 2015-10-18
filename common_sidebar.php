<div id="sidebar_container">
                <div class="sidebar">
            <?php
                include_once("/var/www/includes/game.php");
                $g = new game();
                $time= $g->get_game_timeline();
            ?>  
                  <h3>#hackTheFlag</h3>
                 Start On <h2><font color='red'><?php echo $time[0]; ?></font></h2>
                 Ends On <h2><font color="red"><?php echo $time[1]; ?></font></h2>
                  <p>Refrain from any malpractices such as sharing of flag. <a href="/readme.php">Read more</a>
                  <br/><br/>Compare how far ahead you are of everyone else. Check <a href="/scoreboard.php">scoreboard</a></p>
                </div>
	
                <div class="sidebar">
					<p><a href="/team.php">HackTeam</a> Behind the scene!!! ;-)</p>
                </div>
          </div>

