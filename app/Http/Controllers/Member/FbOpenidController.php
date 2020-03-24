<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Socialite;
use App\Lib\Sns;
use App\Lib\Utils;


class FbOpenidController extends Controller
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
		return Socialite::driver('facebook')->redirect();
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
        	$user = Socialite::driver('facebook')->stateless()->user();
	    } catch (\Exception $e) {
            return redirect ('/');
        }
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
		/*
		$user->getId();
		$user->getNickname();
		$user->getName();
		$user->getEmail();
		$user->getAvatar();       
        */
		
		$sns = new Sns();
		//$user = $sns->getSNSUser($user->getId(), 1, '192.168.0.1', $user->getEmail(), $channelId, $scid, $adId);
		$user = $sns->getSNSUser($user->getId(), 1, $ip, $user->getName(), $user->getAvatar(), $user->getEmail(), 1, 1, 1);		
		\Session::put('USER', $user);
	    
	    if($forward == '') $forward = '/';
		header("Location:$forward");

    }
}
