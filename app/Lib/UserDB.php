<?php
namespace App\Lib;	
use App\Lib\KyotoTycoon;
	
class UserDB {
	
	private $db;
	public function __construct() {
		$this->db = new KyotoTycoon();
		$this->db->connect('127.0.0.1', 1001, 'users.kch');
	}
	
	public function __destruct() {
		$this->db->close();
	}

	public function genUserId() {
		//define('API_SERVER_INDEX', 1);
		//efine('USER_ID_INDEX', 'USER_ID_INDEX_' . API_SERVER_INDEX);

		$userId = $this->db->increment('USER_ID_INDEX_1', 1);
		return $userId;
	}
	
	public function getUser($loginAccount) {
		$loginAccount = strtolower($loginAccount);
		$userContent = $this->db->get($loginAccount);
		return ($userContent) ? unserialize($userContent) : null;

	}
	
	public function saveUser($user) {
		if ($user == null || !is_array($user)) return false;
		
		$loginAccount = strtolower($user['LOGIN_ACCOUNT']);
		return $this->db->set($loginAccount, serialize($user));

	}
	
	public function updateUser($loginAccount, $infoArray) {
		$user = $this->getUser($loginAccount);
		if ($user) {
			foreach ($infoArray as $key => $value) {
				if ($key == 'LOGIN_ACCOUNT') continue; //loginaccount can't fix
				$user[$key] = $value;
			}
			return $this->saveUser($user);
		} else {
			return false;
		}
	}

	public function remove($key) {
		return $this->db->remove($key);
	}		
}