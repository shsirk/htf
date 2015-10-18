<?php

include_once("/var/www/db/mysql_crud.php");

class user { 
	
	private $uid = 0;
	private $uname  ="" ;
	private $email = "";
	private $active = false;

	//create_user
	public function create_user( $uname, $pwd, $email) { 
		$result = false;
		$db = new Database();
		if($db->connect()) { 
			if($db->sql("select u_id FROM users where u_name='" . $uname . "' OR u_email='" . $email . "'")) { 
				$dbRes = $db->getResult();
				if(count($dbRes) != 0) { 
					throw new Exception("Email is already registered");
				}
			}
			$result = $db->insert('users', array( 'u_name' => $uname, 'u_password' => $pwd, 'u_email' => $email ));
			$db->disconnect();
		}
		return $result;		
	}
	
	public function is_user_registered($email) { 
		$result = false;
		$db = new Database();
		if($db->connect()) { 
			if($db->sql('SELECT u_id FROM users WHERE u_email = \'' . $email . '\''))
			{ 
				$dbResult = $db->getResult();
				$result = count($dbResult);
			}
			$db->disconnect();
		}
		return $result;;		
	}

	public function already_activated($uid){ 
		$uid = intval($uid);
		$result = false;
		$db = new Database();
		if($db->connect()) { 
			if($db->sql('SELECT u_id FROM users WHERE u_active=1 AND u_id=' . $uid))
			{ 
				$dbResult = $db->getResult();
				if(count($dbResult) == 1) { 
						$result = true;
				}
			}
			$db->disconnect();
		}
		return $result;;		
	}

	public function get_user_id($email) { 
		$result = 0;
		$db = new Database();
		if($db->connect()) { 
			if($db->sql('SELECT u_id FROM users WHERE u_email = \'' . $email . '\''))
			{ 
				$dbResult = $db->getResult();
				if(count($dbResult) == 1) { 
					$out = $dbResult[0];
					$result = $out['u_id'];
				}
			}
			$db->disconnect();
		}
		return $result;
	}
	//activate_user;
	public function activate_user($uid) { 
		$uid = intval($uid);
		$result = false;
		$db = new Database();
		if($db->connect()) { 
					if($db->update('users', array('u_active'=>1), 'u_id=' . $uid)) { 
						if($db->sql('INSERT INTO score VALUES(' . $uid . ',0,now())'))
							$result = true;
					}
			$db->disconnect();
		}
		return $result;		
	}

	//update_password;
	public function update_password($uid,$old_password, $new_password) { 
		$result = false;
		$db = new Database();
		if($db->connect()) {
			if($old_password != NULL) { 
				if($db->update('users', array('u_password' => $new_password),'u_id=' . $uid . ' AND u_password=\'' . $old_password . '\''))
					$result = true;
			}else {
				if($db->update('users', array('u_password' => $new_password),'u_id=' . $uid ))
					$result = true;
			}
			$db->disconnect();
		}
		return $result;		
	}

	//validate_user()
	public function validate_user($uname , $password) { 
		$result = false; 
		$db = new Database();
		if($db->connect()) { 
			if($db->sql('SELECT u_id,u_email FROM users WHERE u_name = \'' . $uname . '\' AND u_password = \'' . $password . '\' AND u_active = 1'))
			{
				$dbResult = $db->getResult();
				if(count($dbResult) != 0)
				{
					$out = $dbResult[0];
					$this->uid = $out['u_id'];
					$this->uname = $uname;
					$this->email = $out['u_email'];
					$this->active = true;
				
					$result = true;
				}
			}
			$db->disconnect();
		}
		return $result;		
	}

	//get list of all registerd users	
	public function get_all_users() { 
		$users = array() ; 
		$db = new Database();
		if($db->connect()) { 
			if($db->select('users', 'u_id,u_name,u_email,u_active')) { 
				$dbResult = $db->getResult();
				foreach($dbResult as $out)
				{
					$u = new user();
					$u->set_user_information($out['u_id'], $out['u_name'], $out['u_email'], $out['u_active']);
					array_push($users, $u);
				}	
			}
			$db->disconnect();
		}
		return $users;
	} 

	//some getters;
	public function get_uid() { return $this->uid; } 
	public function get_uname() { return $this->uname; } 
	public function get_email() { return $this->email; } 
	public function is_active() { return $this->active; }

	//only one setter
	public function set_user_information( $uid, $uname, $email , $active) { 
		$this->uid = $uid;
		$this->uname = $uname;
		$this->email = $email;
		$this->active = $active;
	}
}
	
?>
