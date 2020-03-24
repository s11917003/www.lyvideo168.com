<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Socialite;
use App\Lib\Sns;
use App\Lib\Utils;

class IgOpenidController extends Controller
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
		return Socialite::driver('instagram')->redirect();
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
        	$user = Socialite::driver('instagram')->stateless()->user();
	    } catch (\Exception $e) {
            return redirect ('/');
        }
        
        var_dump($user);
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
		$user = $sns->getSNSUser($user->getId(), 4, $ip, $user->getName(), $user->getAvatar(), $user->getEmail(), 1, 1, 1);
		//if($forward == '') $forward = '/';

		\Session::put('USER', $user);
		
		if($forward == '') $forward = '/';
		header("Location:$forward");
    }
    
    /*
object(SocialiteProviders\Manager\OAuth2\User)#214 (10) { ["accessTokenResponseBody"]=> array(2) { ["access_token"]=> string(51) "1269295321.eb74b7e.5ae1fc08326d483cb335066e94ea1f20" ["user"]=> array(7) { ["id"]=> string(10) "1269295321" ["username"]=> string(12) "carterwu1019" ["profile_picture"]=> string(132) "https://scontent.cdninstagram.com/vp/7391797e8ea458c32c2227d3f828b194/5B36D0C4/t51.2885-19/10666054_695111647291052_1298906976_a.jpg" ["full_name"]=> string(9) "Carter Wu" ["bio"]=> string(0) "" ["website"]=> string(0) "" ["is_business"]=> bool(false) } } ["token"]=> string(51) "1269295321.eb74b7e.5ae1fc08326d483cb335066e94ea1f20" ["refreshToken"]=> NULL ["expiresIn"]=> NULL ["id"]=> string(10) "1269295321" ["nickname"]=> string(12) "carterwu1019" ["name"]=> string(9) "Carter Wu" ["email"]=> NULL ["avatar"]=> string(132) "https://scontent.cdninstagram.com/vp/7391797e8ea458c32c2227d3f828b194/5B36D0C4/t51.2885-19/10666054_695111647291052_1298906976_a.jpg" ["user"]=> array(8) { ["id"]=> string(10) "1269295321" ["username"]=> string(12) "carterwu1019" ["profile_picture"]=> string(132) "https://scontent.cdninstagram.com/vp/7391797e8ea458c32c2227d3f828b194/5B36D0C4/t51.2885-19/10666054_695111647291052_1298906976_a.jpg" ["full_name"]=> string(9) "Carter Wu" ["bio"]=> string(0) "" ["website"]=> string(0) "" ["is_business"]=> bool(false) ["counts"]=> array(3) { ["media"]=> int(1) ["follows"]=> int(23) ["followed_by"]=> int(59) } } }	*/
}
