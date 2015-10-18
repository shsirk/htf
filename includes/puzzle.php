<?php

include_once("/var/www/db/mysql_crud.php");
error_reporting(E_ALL);

class question { 
	private $qid ;
	private $cid ;
	private $qname; 
	private $qtag;
	private $qhint;
	private $qpoints;
	private $flag;

	public function get_questions_list( $cid) { 
		$result = array();
	
		$db = new Database();
		if($db->connect()) { 
			if($db->select('questions', 'q_id,q_name,q_tag,q_hint,q_points', NULL, 'c_id=' . $cid))
			{
				$dbResult = $db->getResult();
				foreach($dbResult as $out)
				{
					$q = new question();
					$q->set_question_information(
						$out['q_id'],
						$cid,
						$out['q_name'],
						$out['q_tag'],
						$out['q_hint'],
						$out['q_points'] ) ;

					array_push($result, $q);
				}
			}
			$db->disconnect();
		}

		return $result;
	}

	public function get_question_details( $qid ) { 
		$result = array();
		$db = new Database(); 
		if($db->connect()) { 
			if($db->select('questions', 'q_id,c_id,q_name,q_tag,q_hint,q_points', NULL, 'q_id=' . $qid))
			{
				$dbResult = $db->getResult();
				foreach($dbResult as $out)
				{
					$q = new question();
					$q->set_question_information(
						$out['q_id'],
						$out['c_id'],
						$out['q_name'],
						$out['q_tag'],
						$out['q_hint'],
						$out['q_points'] ) ;

					array_push($result, $q);
				}
			}
			$db->disconnect();
		}
		return $result;
	}
 
	public function set_question_information($qid, $cid,  $qname, $qtag, $qhint, $qpoints, $flag = "")
	{
		$this->qid = $qid;
		$this->cid = $cid;
		$this->qname = $qname;
		$this->qtag = $qtag;
		$this->qhint = $qhint;
		$this->qpoints = $qpoints;
		$this->flag = $flag;
	}

	public function get_qid() { return $this->qid; } 
	public function get_cid() { return $this->cid; }
	public function get_qname() { return $this->qname ; } 
	public function get_qtag() { return $this->qtag; } 
	public function get_hint() { return $this->qhint; } 
	public function get_qpoints() { return $this->qpoints; }

} 

?>
