<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Socialite;
use App\Lib\Sns;
use App\Lib\Utils;

class GgOpenidController extends Controller
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
		return Socialite::driver('google')->redirect();
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
        	$user = Socialite::driver('google')->user();
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
        
        
		$nick = $user->getName();
		if($nick == NULL) $nick = '哈友_神秘客';
				
		$sns = new Sns();
		//$user = $sns->getSNSUser($user->getId(), 1, '192.168.0.1', $user->getEmail(), $channelId, $scid, $adId);
		$user = $sns->getSNSUser($user->getId(), 2, $ip, $nick, $user->getAvatar(), $user->getEmail(), 1, 1, 1);
		if($forward == '') $forward = '/';
		
		//var_dump($user);
		\Session::put('USER', $user);
		
		if($forward == '') $forward = '/';
		header("Location:$forward");
				
    }
    
    /*
object(SocialiteProviders\Manager\OAuth2\User)#212 (10) { ["accessTokenResponseBody"]=> array(4) { ["access_token"]=> string(137) "ya29.GmGFBeHBItzzqvZ6scUO6DyiF31vK8DGF35ywz0oRxs88fKp-1RQlzHMLyvm9Ep4Q8s3R4zuumAJvvMKgUYiMm_Xynokyy-cF-l1Im7cFmEBiJcVau0Fr0MJVjhqagJbrzJM" ["expires_in"]=> int(3599) ["id_token"]=> string(889) "eyJhbGciOiJSUzI1NiIsImtpZCI6ImM2ZjBlZTE2YmU3MGM0ODhkZDM5ZGI3MGY2ZjRkMTM3YTA0ODkxZTMifQ.eyJhenAiOiI2NjU2MDMzMzkxNDItNG84a2lzbWNvdnY5aGpnbDcybjNvMHV2Z21ra2czNDAuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJhdWQiOiI2NjU2MDMzMzkxNDItNG84a2lzbWNvdnY5aGpnbDcybjNvMHV2Z21ra2czNDAuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJzdWIiOiIxMDgwODUzNjg3MzY2OTk4NzIyMzMiLCJlbWFpbCI6ImM4Yzh0di5yaWNoQGdtYWlsLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJhdF9oYXNoIjoiZVVBaTlvVTRNTmt6Y2hVWmEzRUhLZyIsImV4cCI6MTUyMTYzMDM3OSwiaXNzIjoiYWNjb3VudHMuZ29vZ2xlLmNvbSIsImlhdCI6MTUyMTYyNjc3OX0.g4Tfg8VGyiQxQi9SUaqGtOYTIVhWJj_rrL9nXZDMZU2e4QHxmNmEDmX0He_8FkgHXYpnkOym6gnDcp50xn9_mexvVHsIkCEsV4ExlZv4MDfgVb4AX_J2LWFdefYK7EsNRFaUUF-KGU40SzHW09JeXqYh2g8Btlx6YCkcQ9dxkoosY2oBZ4pXnlV9CanDuQ7109iUjrWBHKsN5hz6LNirWlP7UE19D4oxbAovwLnQMiM-F4W1i2slCQxy-f6khw123F96ZvwGjrLmAuGJ1RtESTQEd_Pm-fGS1-qaQt8X5vplG94Rn3GlOgaDg3Ki_njHzvIS7m-pqqU0Mkho5sdhXw" ["token_type"]=> string(6) "Bearer" } ["token"]=> string(137) "ya29.GmGFBeHBItzzqvZ6scUO6DyiF31vK8DGF35ywz0oRxs88fKp-1RQlzHMLyvm9Ep4Q8s3R4zuumAJvvMKgUYiMm_Xynokyy-cF-l1Im7cFmEBiJcVau0Fr0MJVjhqagJbrzJM" ["refreshToken"]=> NULL ["expiresIn"]=> int(3599) ["id"]=> string(21) "108085368736699872233" ["nickname"]=> NULL ["name"]=> string(0) "" ["email"]=> string(21) "c8c8tv.rich@gmail.com" ["avatar"]=> string(98) "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50" ["user"]=> array(13) { ["kind"]=> string(11) "plus#person" ["etag"]=> string(57) ""EhMivDE25UysA1ltNG8tqFM2v-A/_tU4ZInObQFxl28zYWKdHppaCQg"" ["emails"]=> array(1) { [0]=> array(2) { ["value"]=> string(21) "c8c8tv.rich@gmail.com" ["type"]=> string(7) "account" } } ["objectType"]=> string(6) "person" ["id"]=> string(21) "108085368736699872233" ["displayName"]=> string(0) "" ["name"]=> array(2) { ["familyName"]=> string(0) "" ["givenName"]=> string(0) "" } ["image"]=> array(2) { ["url"]=> string(98) "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50" ["isDefault"]=> bool(true) } ["isPlusUser"]=> bool(false) ["language"]=> string(5) "zh_TW" ["ageRange"]=> array(1) { ["min"]=> int(21) } ["circledByCount"]=> int(0) ["verified"]=> bool(false) } }	    
	*/
}
