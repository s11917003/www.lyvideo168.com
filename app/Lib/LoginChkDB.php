<?php
namespace App\Lib;	
use App\Lib\KyotoTycoon;

class LoginChkDB {
	private $db;
	
	public function __construct() {
		$this->db = new KyotoTycoon();
		$this->db->connect('127.0.0.1', 1001, 'platform.kch');

	}
	
	public function __destruct() {
		$this->db->close();
	}
	
	public function getChkCode($loginAccount) {

		$loginAccount = strtolower($loginAccount);
		$chkCode = $this->db->get($loginAccount);
		return ($chkCode) ? unserialize($chkCode) : null;

	}
	
	public function setChkCode($loginAccount,$chkCode) {

		$loginAccount = strtolower($loginAccount);
		return $this->db->set($loginAccount, serialize($chkCode));

	}
}