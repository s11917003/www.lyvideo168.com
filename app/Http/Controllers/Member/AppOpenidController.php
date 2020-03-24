<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Socialite;
use App\Lib\Sns;
use App\Lib\Utils;
use App\Lib\LoginChkDB;
use App\Lib\User;


class AppOpenidController extends Controller
{ 
	public function register(Request $request) {
		
		$uid = $request->input('opid');
		$name = $request->input('name');
		$pic = $request->input('pic');
		$mail = $request->input('mail', '');
		$type = $request->input('usertype');   //1:fb, 2:google
		
		\Log::info("$uid,$name,$pic,$mail,$type");
		if($uid && $name && $pic && $type) {
			$sns = new Sns();
			//$user = $sns->getSNSUser($user->getId(), 1, '192.168.0.1', $user->getEmail(), $channelId, $scid, $adId);
			$user = $sns->getSNSUser($uid, $type, '', $name, $pic, $mail, 1, 1, 1);			
		}
		
		/*
		$u = new User();
		$user = $u->getUser('00000546@line');
		*/

		if($user) {
			//生成token
			$token = md5("c8c8tv".rand());
			$loginChkDB = new LoginChkDB();
			$loginChkDB->setChkCode($user['USER_ID'], $token);
			
			
			if(@!$user['ABOUT'] || @$user['ABOUT'] == '') {
				$user['ABOUT'] = '他很懶什麼也沒說...';
			}
			
			
			return response()->json([
				'ret'=>'1',
				'userid' => $user['USER_ID'],
				'account' => $user['LOGIN_ACCOUNT'],
				'nick' => $user['NICK_NAME'],
				'avatar' => $user['AVATAR'],
				'about' => @$user['ABOUT'],
				'token' => $token,
				'msg' => '成功'
			]);					
		} else {
			return response()->json([
				'ret'=>'0',
				'msg' => '登入錯誤'
			]);			
		}		
		
	}
	
	public function loginchk(Request $request) {
		$account = $request->input('account', 'cccaaa');
		$token = $request->input('token', '123123');
		
		if($account && $token) {
			$loginChkDB = new LoginChkDB();
			$nowtoken = $loginChkDB->getChkCode($account);
		} else {
			return  response()->json([
				'ret' => '0',
				'msg' => '登入狀態失效',
			]);			
		}
		
		if($token != $nowtoken ) {
			return  response()->json([
				'ret' => '0',
				'msg' => '登入狀態失效',
			]);
		} else {
			return  response()->json([
				'ret' => '1',
				'msg' => '登入成功',
			]);			
		}
	}
	
	public function infoupdate(Request $request) {
		$userid = $request->input('userid');
		$account = $request->input('account');
		$token = $request->input('token');
		
		$name = $request->input('username');
		$about = $request->input('aboutme');
		$file = $request->file('photo');

		$loginChkDB = new LoginChkDB();
		$nowtoken = $loginChkDB->getChkCode($userid);
		
		if(!$token || !$userid || !$account) {
			return  response()->json([
				'ret' => '0',
				'msg' => '登入狀態失效',
			]);				
		}
		
		if($token != $nowtoken) {
			return  response()->json([
				'ret' => '0',
				'msg' => '登入狀態失效',
			]);			
		}
		
		$u = new User();
		$user = $u->getUser($account);
		
		if($file) {
			$disk = \Storage::disk('gcs');
			$filename = $userid . '_head_img';
			$ext = str_replace('image/', '', $file->getClientMimeType());
			\Log::info($ext);
			$path = '/headimage';
			$disk->putFileAs($path, $file, $filename . '.' . $ext, 'public');
			$gcpfile = $disk->exists($path . '/' . $filename . '.' . $ext );
			$user['AVATAR'] = 'https://source.c8c8tv.com'. $path . '/' . $filename . '.' . $ext;
		}
		
		
		$user['NICK_NAME'] = $name;
		$user['ABOUT'] = $about;
		$u->saveUser($user);
		
	
		if($user) {
			return  response()->json([
				'ret' => '1',
				'msg' => '資訊已更新',
				'data' => [
					'nick' => $name,
					'about' => $about,
					'avatar' => $user['AVATAR']
				]	
			]);				
		} else {
			return  response()->json([
				'ret' => '0',
				'msg' => '未知的錯誤',
			]);				
		}
	}
}