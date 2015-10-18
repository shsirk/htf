<?php

include_once("/var/www/db/mysql_crud.php");

error_reporting(E_ALL);

class scoreboard { 
	private $user;
	private $email;
	private $score;
	private $time; 

	public function set_scoreboard($u, $e, $s, $t) { 
		$this->user = $u;
		$this->email = $e;
		$this->score= $s;
		$this->time = $t;
	}

	public function get_user() { return $this->user;  } 
	public function get_email() { return $this->email; }
	public function get_score() { return $this->score; }
	public function get_time() { return $this->time; }
}

class my_scoreboard { 
	private $category;
	private $question;
	private $score;
	
	public function set_scoreboard($c, $q, $s) { 
		$this->category = $c;
		$this->question = $q;
		$this->score = $s;
	}
	public function get_category() { return $this->category; } 
	public function get_question() { return $this->question; }
	public function get_score() { return $this->score; } 
}
 
class game { 

	public function solved_already($uid, $qid) {
		$result = false;
		$db = new Database();
		if($db->connect()) { 
			$result = $this->is_question_solved($db,$uid,$qid);
			$db->disconnect();
		}
		return $result;
	}

	public function get_user_score($uid) {
		$result = 0;
		$db = new Database();
		if($db->connect()) { 
			$result = $this->get_total_score_of_user($db,$uid);
			$db->disconnect();
		}
		return $result;
	}
	public function get_points_of_flag($cid, $qid, $flag) {
		$result = 0;
		$db = new Database();
		if($db->connect()) { 
			$result = $this->get_points_if_flag_correct($db,$cid,$qid,$flag);
			$db->disconnect();
		}
		return $result;
	}

	public function verify_flag($uid, $cid, $qid, $flag) { 
		$result = false;;
		$db = new Database();
		if($db->connect())
		{		
			if(!$this->is_game_on_internal($db))
				throw new Exception("Game timeline has been ended");

			if(!$this->is_question_solved($db, $uid , $qid)) {
				$points = $this->get_points_if_flag_correct($db, $uid, $qid, $flag);
				if($points != 0) {
					$total_score = $this->get_total_score_of_user($db, $uid);
					$newScore = intval($total_score) + intval($points) ;
					if($db->sql('UPDATE score SET s_updatedtime = NOW(), s_total_score = ' . $newScore . ' WHERE u_id=' . $uid))
					{
						if($db->sql('INSERT INTO scoretable (q_id,u_id,s_solvetime) values (' . $qid . ',' . $uid . ',now())'))
						{
							 $result = true; 
						}
					}
				} else { 
					throw new Exception("Bad Luck, Try Again");
				}
			} else { 
				throw new Exception("You have already solved this question");
			}
			$db->disconnect();
		}
		return $result;
	} 
	
	private function get_total_score_of_user($db, $uid) {
		$score = 0;
		if($db->select('score', 's_total_score' , NULL, 'u_id=' . $uid )) {
			$dbResult = $db->getResult();
			if(count($dbResult) != 0)	{
				$out = $dbResult[0];
				$score = $out['s_total_score'];
			}
		}
		return $score;
	}

	private function get_points_if_flag_correct($db, $uid , $qid, $flag) { 
		$points = 0;
		if($db->select('questions', 'q_points' , NULL, 'q_id=' . $qid . ' AND flag=\'' . $flag . '\'')) {
			$dbResult = $db->getResult();
			if(count($dbResult) != 0)	{
				$out = $dbResult[0];
				$points = $out['q_points'];
			}
		}
		return $points;
	} 
	
	private function is_question_solved($db, $uid, $qid) { 
		$result = false;
		if($db->sql('SELECT s_id,s_solvetime FROM scoretable WHERE u_id=' . $uid . ' AND q_id=' . $qid)) { 
			$dbResult = $db->getResult();
			if (count($dbResult) != 0 )
				{ $result = true; }
		}
		return $result;
	}

    public function get_scoreboard() { 
		$sboard = array();
		$db = new Database();
		if($db->connect()) { 
			$query = "SELECT u.u_name, u.u_email, s.s_total_score, s.s_updatedtime FROM users u, score s WHERE u.u_id = s.u_id AND u.u_active <> 0 ORDER BY s.s_total_score DESC, s.s_updatedtime ASC";
			if($db->sql($query))  { 
				$dbResult = $db->getResult();
				foreach($dbResult as $out)
				{
					$s = new scoreboard();
					$s->set_scoreboard($out['u_name'], $out['u_email'], $out['s_total_score'], $out['s_updatedtime']);
					array_push($sboard,$s);		
				}
			}
			$db->disconnect();
		}
		return $sboard;
	} 

	public function get_my_scoreboard($uid){ 
		$sboard = array();
		$db = new Database();
		if($db->connect()) { 
			$query = "select c.c_name, q.q_tag, q.q_points FROM categories c, questions q, scoretable s, users u WHERE s.q_id = q.q_id AND s.u_id = u.u_id AND q.c_id = c.c_id AND u.u_id=" . $uid;
			if($db->sql($query))  { 
				$dbResult = $db->getResult();
				foreach($dbResult as $out)
				{
					$s = new my_scoreboard();
					$s->set_scoreboard($out['c_name'], $out['q_tag'], $out['q_points']);
					array_push($sboard,$s);		
				}
			}
			$db->disconnect();
		}
		return $sboard;
	}
	
	public function get_game_timeline() { 
		$result = array(); 
		$db = new Database();
		if($db->connect()) { 
			if($db->select('game_timeline', 'start_time,end_time' )) { 
				$dbResult = $db->getResult();
				if (count($dbResult) != 0 )
				{
					$out = $dbResult[0];
					array_push($result, $out['start_time']);
					array_push($result, $out['end_time']);
				}
			}
			$db->disconnect();
		}
		return $result;
	}
	
	public function is_game_on() { 
		$result = false;
		$db = new Database();
		if($db->connect()){ 
			if($db->sql("select * from game_timeline where now() >= start_time AND now() <= end_time")) { 
				$dbResult = $db->getResult();
				if (count($dbResult) != 0 )
					$result = true;
			}
			$db->disconnect();
		}
		return $result;
	}
	public function is_game_on_internal($db){ 
		$result = false;
			if($db->sql("select * from game_timeline where now() >= start_time AND now() <= end_time")) { 
				$dbResult = $db->getResult();
				if (count($dbResult) != 0 )
					$result = true;
			}
		return $result;
	}
} 

?>
