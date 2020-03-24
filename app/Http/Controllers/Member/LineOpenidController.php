<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Socialite;
use App\Lib\Sns;
use App\Lib\Utils;

class LineOpenidController extends Controller
{ 
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider(Request $request)
    {
		\Session::put('FORWARD', $request->input('forward', '/'));
	    \Session::put('CHANNEL_ID', $request->input('channel_id', 0));
	    \Session::put('CHANNEL_PARAM', $request->input('channel_param', ''));
	    \Session::put('AD_ID', $request->input('ad_id', 0));		    
		return Socialite::driver('line')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
		$forward = \Session::get('FORWARD', '/');
	    $channelId = \Session::get('CHANNEL_ID', 0);
	    $scid = \Session::get('CHANNEL_PARAM', '');
	    $adId = \Session::get('AD_ID', 0);
	    $ip =  Utils::getIp();	    
	    
	    try {
        	$user = Socialite::driver('line')->user();
	    } catch (\Exception $e) {
            
            echo '錯誤';
            //var_dump($e);
            return redirect ('/');
        }
        //var_dump($user);
		 // OAuth Two Providers
		/*
		$token = $user->token;
		$refreshToken = $user->refreshToken; // not always provided
		$expiresIn = $user->expiresIn;
		*/
		
		// OAuth One Providers
		//$token = $user->token;
		//$tokenSecret = $user->tokenSecret;
		
		// All Providers
		
		//echo $user->getId();
		//echo $user->getNickname();
		//echo $user->getName();
		//echo $user->getEmail();
		//echo $user->getAvatar();       
        
        
		$nick = $user->name;
		if($nick == NULL) $nick = '哈友_神秘客';
				
		$sns = new Sns();
		//$user = $sns->getSNSUser($user->getId(), 1, '192.168.0.1', $user->getEmail(), $channelId, $scid, $adId);
		$user = $sns->getSNSUser($user->id, 5, $ip, $nick, $user->avatar, $user->email, 1, 1, 1);
		if($forward == '') $forward = '/';
		
		//var_dump($user);
		\Session::put('USER', $user);
		
		if($forward == '') $forward = '/';
		header("Location:$forward");
				
    }
    
    /*
    
	*/
}
