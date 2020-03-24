<?php
namespace App\Lib;	
use App\Lib\SnsDB;
use App\Lib\User;
use App\Model\UserOpenid;
use App\Model\Users;

class Sns {

	public function getSNSUser($idcode, $userType, $ip ='', $nick = '', $avatar = '',  $email = '', $channelId = 0, $channelParam = '', $adId = '') {

		$snsdb = new SnsDB();						
		$loginAccount = $snsdb->getMapping($idcode, $userType);
		if ($loginAccount) {
			$u = new User();
			$user = $u->getUser($loginAccount);
			
			if (!$user) {
				$user = $u->thirdpartregister($loginAccount, $userType, $ip, $nick, $avatar, $email, $channelId, $channelParam, $adId);
				//add openid uid record
				$uo = new UserOpenid();
				$uo->user_id = $user['USER_ID'];
				$uo->type = $userType;
				$uo->uname = $nick;
				$uo->openid = $idcode;
				$uo->save();
				
			}
			/*
			else {
				if($user['AVATAR'] != $avatar) {
					$user['AVATAR'] = $avatar;
					$user['NICK_NAME'] = $nick;
					$u->saveUser($user);
					
					$uv = Users::find($user['USER_ID']);
					//$uv->getUser($loginAccount);
					$uv->nick_name = $nick;
					$uv->avatar = $avatar;
					$uv->save();
				}
			}
			*/			
			return $user;
		}
		return false;
	}
}