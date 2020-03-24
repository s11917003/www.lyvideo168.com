<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Socialite;
use App\Lib\Sns;
use App\Lib\Utils;

class TwitterOpenidController extends Controller
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
		return Socialite::driver('twitter')->redirect();
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
        	$user = Socialite::driver('twitter')->stateless()->user();
	    } catch (\Exception $e) {
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
		/*
		echo $user->getId();
		echo $user->getNickname();
		echo $user->getName();
		echo $user->getEmail();
		echo $user->getAvatar();       
        */
		
		
		$sns = new Sns();
		$user = $sns->getSNSUser($user->getId(), 3, $ip, $user->getName(), $user->getAvatar(), $user->getEmail(), 1, 1, 1);

		\Session::put('USER', $user);
		
		if($forward == '') $forward = '/';
		header("Location:$forward");
    }
    
    /*
object(SocialiteProviders\Manager\OAuth1\User)#214 (9) { ["accessTokenResponseBody"]=> array(5) { ["oauth_token"]=> string(50) "976385608728719360-3td48dScoc2Ub3VTqBncGE9xFwYYduJ" ["oauth_token_secret"]=> string(45) "B99Sas7NrweqxdpqsAjLpyHVNX5Cs0PwRiLPs4B1KGnzp" ["user_id"]=> string(18) "976385608728719360" ["screen_name"]=> string(6) "c8c8tv" ["x_auth_expires"]=> string(1) "0" } ["token"]=> string(50) "976385608728719360-3td48dScoc2Ub3VTqBncGE9xFwYYduJ" ["tokenSecret"]=> string(45) "B99Sas7NrweqxdpqsAjLpyHVNX5Cs0PwRiLPs4B1KGnzp" ["id"]=> int(976385608728719360) ["nickname"]=> string(6) "c8c8tv" ["name"]=> string(8) "哈哈TV" ["email"]=> NULL ["avatar"]=> string(77) "http://abs.twimg.com/sticky/default_profile_images/default_profile_normal.png" ["user"]=> array(31) { ["id_str"]=> string(18) "976385608728719360" ["entities"]=> array(1) { ["description"]=> array(1) { ["urls"]=> array(0) { } } } ["protected"]=> bool(false) ["followers_count"]=> int(0) ["friends_count"]=> int(0) ["listed_count"]=> int(0) ["created_at"]=> string(30) "Wed Mar 21 09:10:44 +0000 2018" ["favourites_count"]=> int(0) ["utc_offset"]=> NULL ["time_zone"]=> NULL ["geo_enabled"]=> bool(false) ["verified"]=> bool(false) ["statuses_count"]=> int(0) ["lang"]=> string(5) "zh-tw" ["contributors_enabled"]=> bool(false) ["is_translator"]=> bool(false) ["is_translation_enabled"]=> bool(false) ["profile_background_color"]=> string(6) "F5F8FA" ["profile_background_tile"]=> bool(false) ["profile_link_color"]=> string(6) "1DA1F2" ["profile_sidebar_border_color"]=> string(6) "C0DEED" ["profile_sidebar_fill_color"]=> string(6) "DDEEF6" ["profile_text_color"]=> string(6) "333333" ["profile_use_background_image"]=> bool(true) ["has_extended_profile"]=> bool(false) ["default_profile"]=> bool(true) ["default_profile_image"]=> bool(true) ["following"]=> bool(false) ["follow_request_sent"]=> bool(false) ["notifications"]=> bool(false) ["translator_type"]=> string(4) "none" } }
	*/
}
