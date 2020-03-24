<?php
namespace App\Lib;	
use App\Lib\UserDB;
use Illuminate\Support\Facades\Log;
//use Illuminate\Support\Facades\DB;

use App\Model\Users;


//use Illuminate\Support\Facades\DB;
	
class User {
	public function getUser($loginAccount, $ip = '')
	{
		$UserDB = new UserDB();
		$user = $UserDB -> getUser($loginAccount);
		if (empty($user['REVERSE_BIND_ACCOUNT']) === false)
			$user = $UserDB -> getUser($user['REVERSE_BIND_ACCOUNT']);
		if (empty($ip) === false)
		{
			$UserDB -> updateUser($loginAccount, array('LAST_LOGIN_IP' => $ip, 'LAST_LOGIN_TIME' => date('Y-m-d H:i:s')));
		}

		return $user;
	}
	
	public function register($loginAccount, $password, $nick, $avatar, $email, $ip, $userType, $channelId=1, $channelParam='', $adId=0) {
		$db = new UserDB();
		$user = $db->getUser($loginAccount);	//	檢查帳號是否重覆
		if (!$user) {

			$id = $db->genUserId();			//	取UserId
			$now = date('Y-m-d H:i:s');
			$passwordEncrypted = sha1(strtolower($password));
			$user = [
				'USER_ID' => $id,
				'LOGIN_ACCOUNT' => $loginAccount,
				'PASSWORD' => $passwordEncrypted,
				'NICK_NAME' => $nick,
				'AVATAR' => $avatar,
				'USER_TYPE' => $userType,
				'ABOUT' => '',
				'EMAIL' => $email,
				'REG_TIME' => $now,				
				'IP' => $ip,
				'CHANNEL_ID' => $channelId,
				'CHANNEL_PARAM1' => $channelParam,
				'AD_ID' => $adId,
			];

			//記錄註冊日誌
			Log::info('register', $user);
			if ($db->saveUser($user)) {	//	寫入NOSQLDB
				$uv = new Users;						//	建立用戶物件
				$uv->user_id = $id;
				$uv->login_account = $loginAccount;
				$uv->password = $passwordEncrypted;
				$uv->nick_name = $nick;
				$uv->avatar = $avatar;
				$uv->bind_account = '';
				$uv->reverse_bind_account = '';				
				$uv->user_type = $userType;
				$uv->email = $email;
				$uv->phone = '';
				$uv->block = 0;
				$uv->save();		//執行寫入
				
				//加入log
				\DB::table('users_registerlog')->insert([
					'user_id' => $id,
					'login_account' => $loginAccount,
					'user_type' => $userType,
					'reg_time' => $now,
					'ip' => $ip,
					'channel_id' => $channelId,
					'channel_param1' => $channelParam,
					'ad_id' => $adId
				]);				
				return $user;

			} else {
				return -2; //數據庫錯誤
			}
		} else {
			return -1; //用戶已註冊
		}
	}

	public function login($loginAccount, $password, $ip = '') {
		$db = new UserDB();
		$user = $db -> getUser($loginAccount);
		if ($user) {
			if ($user['PASSWORD'] == sha1(strtolower($password))) {

				if (empty($ip) === true) {
					$user['LAST_LOGIN_IP'] = $_SERVER['REMOTE_ADDR'];
				} else {
					$user['LAST_LOGIN_IP'] = $ip;
				}
				$user['LAST_LOGIN_TIME'] = date('Y-m-d H:i:s');
				$db -> updateUser($loginAccount, array('LAST_LOGIN_IP' => $user['LAST_LOGIN_IP'], 'LAST_LOGIN_TIME' => $user['LAST_LOGIN_TIME']));
				$user = $this -> getUser($loginAccount);
				$result = $user;
			} else {
				$result = -2; }//密码错误
		} else {
			$result = -1; //用户不存在
		}
		return $result;
	}
	
	public function saveUser($user) {
		$db = new UserDB();
		return $db->saveUser($user);

	}

	public function updateInfo($loginAccount, $infoArray) {
		$db = new UserDB();
		return $db->updateUser($loginAccount, $infoArray);

	}
	
	/*
	public function addPoint($loginAccount, $point) {
		$user = $this->getUser($loginAccount);
		$oldPoint = array_key_exists('POINT', $user) ? $user['POINT'] : 0;
		if (!$oldPoint) $oldPoint = 0;
		$oldPoint += intval($point);
		$user['POINT'] = $oldPoint;
		$this->saveUser($user);

		return $user;

	}
	*/
	
	public function thirdpartregister($loginAccount, $userType, $ip = '', $nick, $avatar , $email = '', $channelId = 0, $channelParam = '', $adId = '') {

		$u = new UserDB();
		$id = (int)substr($loginAccount, 0, 8);
		$now = date('Y-m-d H:i:s');
		//default
		$autoPwd = sha1($loginAccount);
		$bindingUser = null;
		$reverseBindingUser = null;
		$email = $email;
		$upgradeTime = null;
		
		$user = [
			'USER_ID' => $id,
			'LOGIN_ACCOUNT' => $loginAccount,
			'PASSWORD' => '',
			'NICK_NAME' => $nick,
			'AVATAR' => $avatar,
			'USER_TYPE' => $userType,
			'ABOUT' => '',
			'EMAIL' => $email,
			'REG_TIME' => $now,				
			'IP' => $ip,
			'CHANNEL_ID' => $channelId,
			'CHANNEL_PARAM1' => $channelParam,
			'AD_ID' => $adId
		];
		
		/*		
		$user = $u->getUser($loginAccount);
		if($user) {
			return -1; //用戶已註冊
		}
		*/		
		//記錄註冊日誌
		Log::info('register_third', $user);
		
		if ($u->saveUser($user)) {
			$uv = new Users;						//	建立用戶物件
			$uv->user_id = $id;
			$uv->login_account = $loginAccount;
			$uv->nick_name = $nick;
			$uv->avatar = $avatar;
			$uv->bind_account = '';
			$uv->reverse_bind_account = '';
			$uv->password = sha1($autoPwd);;
			$uv->user_type = $userType;
			$uv->email = $email;
			$uv->phone = '';
			$uv->block = 0;
			$uv->save();		//執行寫入			
			
			//加入log
			\DB::table('users_registerlog')->insert([
				'user_id' => $id,
				'login_account' => $loginAccount,
				'user_type' => $userType,
				'reg_time' => $now,
				'ip' => $ip,
				'channel_id' => $channelId,
				'channel_param1' => $channelParam,
				'ad_id' => $adId
			]);	
			return $user;

		} else {
			return -2; //數據庫錯誤
		}
		
	}
	

	public function upgrade($loginAccount, $newLoginAccount, $newPassword, $mail='') {
		
		$user = $this->getUser($newLoginAccount);
		if($user) {
			return -1; //帳號已存在
		}
		
		$usertypeid = 0;
		$gamePoint = 0;
		$oldUser = $this->getUser($loginAccount);
		$now = date('Y-m-d H:i:s');
		
		if(array_key_exists('POINT', $oldUser)) {
			$gamePoint = $oldUser['POINT'];
		}
		
		$passwordEncrypted = sha1(strtolower($newPassword));		
		$newUser = [
			'USER_ID' => $oldUser['USER_ID'],
			'LOGIN_ACCOUNT' => $newLoginAccount,
			'PASSWORD' => $passwordEncrypted,
			'USER_TYPE' => $usertypeid,
			'POINT' => $gamePoint,
			'EMAIL' => $mail,
			'BINDING_ACCOUNT' => $oldUser['LOGIN_ACCOUNT']
		];
		
		if ($this->saveUser($newUser)) {
			/* -- 建立新用戶資料物件 -- */
			$uv = new Users;						
			$uv->USER_ID = $oldUser['USER_ID'];
			$uv->LOGIN_ACCOUNT = $newLoginAccount;
			$uv->PASSWORD = $passwordEncrypted;
			$uv->BIND_ACCOUNT = $loginAccount;
			$uv->REVERSE_BIND_ACCOUNT = '';				
			$uv->USER_TYPE = 0;
			$uv->EMAIL = $mail;
			$uv->PHONE = '';
			$uv->BLOCK = 0;
			$uv->save();		//執行寫入		
			
			DB::table('registerlog')->insert([
				'USER_ID' => $oldUser['USER_ID'],
				'LOGIN_ACCOUNT' => $newLoginAccount,
				'USER_TYPE' => 0,
				'REG_TIME' => $now,
				'IP' => $oldUser['IP'],
			]);	
			
			$oldUser['REVERSE_BIND_ACCOUNT'] = $newUser['LOGIN_ACCOUNT'];
			$this->saveUser($oldUser);
			//Users::where('LOGIN_ACCOUNT', $loginAccount)->update(['REVERSE_BIND_ACCOUNT' => $newUser['LOGIN_ACCOUNT']]);
			$acc = Users::find($loginAccount);
			$acc->REVERSE_BIND_ACCOUNT = $newUser['LOGIN_ACCOUNT'];
			$acc->save();
			
		}
		
		//更新支付相關資訊
		$sql = "CALL `user_upgrade`( ?, ?, ?, ?);";
		if(DB::select($sql, [$oldUser['USER_ID'], $oldUser['LOGIN_ACCOUNT'], $oldUser['USER_ID'], $newLoginAccount]) > 0) {
			$user = $this->getUser($newLoginAccount);
			if($user['BINDING_ACCOUNT'] == $loginAccount) {
				return $user;
			}
		}

		return -2; //error		
	}
	
	public function checkLogin() {
		$user = \Session::get('USER');
		if(!$user) {
			return false;
		} else {
			return $user;
		}
	}	
}