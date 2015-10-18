<?php

include_once("/var/www/db/mysql_crud.php");
//error_reporting(E_ALL);

class category { 
	private $cid ;
	private $cname; 

	public function create_category($cid, $cname) { 
		$db = new Database();
		if(!$db->connect())
			return false;
		if(!$db->insert('categories', array('c_id' => $cid, 'c_name' => $cname)))
			return false;
		$db->disconnect();
		return true;		
	}

	public function update_category($cid, $cname) {
		$db = new Database();
		if(!$db->connect())
			return false;
		if(!$db->update('categories', array('c_name' => $cname),'c_id=' . $cid))
			return false;
		$db->disconnect();
		return true;		
	}

	public function remove_category($cid) { 
		$db = new Database();
		if(!$db->connect())
			return false;
		if(!$db->delete('categories', 'c_id=' . $cid))
			return false;
		$db->disconnect();
		return true;		
	}

	public function get_all_categories() { 
		$db = new Database();
		if(!$db->connect())
			return array();
		if(! $db->select('categories', 'c_id,c_name'))
			return array();
		$result = $db->getResult();
		
		$categories = array();
		foreach($result as $output) { 
			$c = new category() ;
			$c->set_category($output['c_id'], $output['c_name']);
			array_push($categories, $c);
		} 

		$db->disconnect();
		return $categories;		
	}

	public function set_category($cid, $cname) { 
		$this->cid = $cid;
		$this->cname = $cname;
	}
	public function get_cid() { return $this->cid;  }
	public function get_cname() { return $this->cname; } 
} 

?>
