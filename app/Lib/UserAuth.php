<?php
namespace App\Lib;	
use App\Model\UserAuthVO;
use App\Model\BindTimeLog;

class UserAuth {
	
	//註冊
	public function bindlicence($authcode, $day){
		//確定時否有綁定紀錄
		$existauthcode = UserAuthVO::where('auth_code',$authcode)->first();
		$nowdate = date('Y-m-d H:i:s');;

		if($existauthcode) {
			
			$varifydata = $this->varifyLicenceCode($existauthcode->licence_code, $authcode);
			$newauthcode = $varifydata[0];
			if($newauthcode) {
				//還在時效內
				$newexpiretime = date('Y-m-d H:i:s', strtotime($existauthcode->expire_time) + $day * 86400);
				$authcode = $newauthcode;
				
			} else {
				$newexpiretime = date('Y-m-d H:i:s', time() + $day * 86400);
				//給予新時間
			};
			
			$btl = new BindTimeLog;
			$btl->licence_code = $existauthcode->licence_code;
			$btl->days = $day;
			$btl->bind_time = $nowdate;
			$btl->save();
			
			$existauthcode->expire_time = $newexpiretime;
			$existauthcode->save();
			\Log::info($existauthcode);
			return [$existauthcode->licence_code, $authcode];
			
		} else {
			$newlicencecode = $this->genLicenceCode();
			$ua = new UserAuthVO;
			$ua->licence_code = $newlicencecode;
			$ua->auth_code = $authcode;
			$ua->gen_time = $nowdate;
			$ua->expire_time = date('Y-m-d H:i:s', time() + $day * 86400);
			$ua->save();
			
			$btl = new BindTimeLog;
			$btl->licence_code = $newlicencecode;
			$btl->days = $day;
			$btl->bind_time = $nowdate;
			$btl->save();
			
			return [$newlicencecode, $authcode];
		}
	}
	
	public function bindlicencel($licencecode, $day) {
		//確定時否有綁定紀錄
		$existauthcode = UserAuthVO::find($licencecode);
		$nowdate = date('Y-m-d H:i:s');;

		if($existauthcode) {
			
			//檢查是否在時效
			if($this->chkactive($licencecode)) {
				$newexpiretime = date('Y-m-d H:i:s', strtotime($existauthcode->expire_time) + $day * 86400);
			} else {
				$newexpiretime = date('Y-m-d H:i:s', time() + $day * 86400);
				//給予新時間
			};
			
			$btl = new BindTimeLog;
			$btl->licence_code = $licencecode;
			$btl->days = $day;
			$btl->bind_time = $nowdate;
			$btl->save();
			
			$existauthcode->expire_time = $newexpiretime;
			$existauthcode->save();
			\Log::info($existauthcode);
			
			return true;		
		}
		
		return false;
		
	}
	
	//生成新licencecode 不會變
	public function genLicenceCode() {
		$t = time();
		$key = 'gpornauth';
		
		$x = 0;
		while ($x == 0) {
			$licencecode = substr(md5($t.$key.$this->random_str(4)), 8, 8);
			$info = UserAuthVO::find($licencecode);
			
			if($info == null) {
				$x = 1;
			}
 		}		
		return $licencecode;
	}
	
	//生成新authcode 首次開啟應用取得
	public function genAuthCode() {
		$t = time();
		$key = 'gporn';
		
		$x = 0;
		while ($x == 0) {
			$authcode = substr(md5($t.$key.$this->random_str(4)), 8, 15);
			$info = UserAuthVO::where('auth_code',$authcode)->first();
			
			if($info == null) {
				$x = 1;
			}
 		}	
		
		
		return $authcode;
	}
	
	//驗證licence code
	public function varifyLicenceCode($licencecode, $authcode)
	{
		$info = UserAuthVO::find($licencecode);
		if($info == null) {
			return false;
		}
		
		if($info->auth_code != $authcode) {
			return false;
		}
		
		$now = time();
		$expire = strtotime($info->expire_time);
		if( ($now - $expire) >  0) {
			return  false;			
		}
		
		//更新authcode
		$newauthcode = $this->genAuthCode();
		$info->auth_code =  $newauthcode;
		$info->save();
		return [$newauthcode, date('Y-m-d H:i:s', $expire)];	
		//return true;	
	}

	//驗證licence code
	public function chkactive($licencecode)
	{
		$info = UserAuthVO::find($licencecode);
		if($info == null) {
			return false;
		}
		
		$now = time();
		$expire = strtotime($info->expire_time);
		if( ($now - $expire) >  0) {
			return  false;			
		}
		
		return true;
	}
	
	private function random_str($length)
	{
		$keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
	    }
	    return $str;
	}
	
	
}