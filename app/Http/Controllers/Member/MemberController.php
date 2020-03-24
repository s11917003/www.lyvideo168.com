<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller {
	public function login(Request $request) {
		
		$forward = $request->input('forward', \URL::previous());
		//echo($forward);
		
		return  view('app_rwd.member.login',[
			'forward' => $forward
		]);
	}
	
	public function logout() {
		\Session::forget('USER');		
		header("Location:/");	
	}
	
}
