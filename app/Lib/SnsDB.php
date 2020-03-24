<?php
namespace App\Lib;	
use App\Lib\KyotoTycoon;
	
class SnsDB {
	private $db;
	private $prefix = array(
		1 => '%s@fb', 	     //Facebook
		2 => '%s@google',    //Google
		3 => '%s@twitter',   //twitter
		4 => '%s@ig',		 //ig
		5 => '%s@line'		 //line
	);

	public function __construct() {
		$this->db = new KyotoTycoon();
		$this->db->connect('127.0.0.1', 1001, 'sns.kch');
	}

	public function __destruct() {
		$this->db->close();
	}

	public function getMapping($id, $type) {
		$key = sprintf($this->prefix[$type], $id);
		$loginAccount = $this->db->get($key);
		
		if (!$loginAccount) {
			$userdb = new UserDB();
			$userID = $userdb->genUserId();
			$preloginAccount = sprintf("%08d", $userID);
			
			$loginAccount = sprintf($this->prefix[$type], $preloginAccount);
			$this->db->set($key, $loginAccount);
		}
		
		return $loginAccount;

	}


	public function checkMapping($id, $type) {
		$key = sprintf($this->prefix[$type], $id);
		$mapping = $this->db->get($key);

		if($mapping)
			return 1;
		else
			return 0;
	}

}