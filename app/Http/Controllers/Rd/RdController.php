<?php

namespace App\Http\Controllers\Rd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\Utils;
use App\Lib\User;
use App\Lib\UserDB;
use Carbon\Carbon;


use App\Model\PostsComments;
use App\Model\PostsTagRelationships;
use App\Model\PostsArticle;


use Intervention\Image\ImageManager;
use Intervention\Image\Image;
use Intervention\Image\Font;

use Illuminate\Http\File;

use Analytics;
use App\Lib\KyotoTycoon;
use App\Lib\StrFilter;
use App\Lib\MimeReader;
use Illuminate\Support\Facades\DB;
use App\Model\AdArticle;
//use Google\Cloud\Storage\StorageClient;
use \Gumlet\ImageResize;
use App\Lib\UserAuth;
use App\Lib\Purchase;
use App\Model\GooglePaymentLog;

use Chrisyue\PhpM3u8\M3u8;

use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

use Illuminate\Support\Facades\Storage;


class RdController extends Controller {	
	
	public function index(Request $request) {
		
		/*
		$id = $request->input('id');
		
		$pa = new PostsArticle();
		$data = $pa->where('id', '>=', $id)->where('id', '<', $id+10)->get();
		
		foreach ($data as $dd) {
			
			//[videojs_hls url='http://www.gporn.cc/getvideo/379' poster='http://pics.dmm.co.jp/mono/movie/adult/n_709mbral026/n_709mbral026pl.jpg' ]

			
			echo $dd->title . '<br>';
			echo $dd->cover_img . '<br>';
			echo "[videojs_hls url='http://www.gporn.cc/getvideo/$dd->id' poster='$dd->cover_img' ]";
			echo '<br>-----<br>';
		}
		*/
		
		/*
		$article = PostsArticle::find(3448);
		$m3u8Url = $article->video_url;
		$folderUrl = $article->folder;
		$expirtime = time()+3600;
		
		echo public_path() . '/upvideo/' . $m3u8Url . "<br>";
		echo url('/') . '/upvideo/' . $folderUrl . '/';
		*/
		
		//var_dump($data);


	}
	
	private function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
	    }
	    return $str;
	}
	
	
	private function signUrl($url, $filepath) {
		
		//$expires = time() + 3600;
		$expires = 1533286644;
		$keyname = 'c8av-sign-01';
		//$key = base64_decode('mE8oLYXqCNi4zEkcBH_SmA==');
		$key = base64_decode(str_pad(strtr('_XhmtohM02VqcwQmg2OOrw==', '-_', '+/'), strlen('_XhmtohM02VqcwQmg2OOrw==') % 4, '=', STR_PAD_RIGHT)); 
		$string = $url . $filepath . '?Expires=' . $expires . '&KeyName=' . $keyname;
		
		//echo $key ;
		
		$signature = $this->signString($key, $string);
		//return $signature;
		return $string . '&Signature=' . $signature;
		
		
		//return $url . $filepath . 'Expires=' . $expires . '&KeyName=' . $keyname . '&Signature' = $signature;
	}
	
	private function signString($key, $string) {
		$str  = hash_hmac("sha1", $string, $key);
		$str = rtrim(strtr(base64_encode($str), '+/', '-_'), '='); 		
		//$str = base64_encode($str);
		return $str;
	}
	
	private function genacc($account) {
		$file = fopen(storage_path('app/tmp/names.txt'), "r");
		$nn = [];
		while ( ($data = fgetcsv($file, 100, ",")) !==FALSE) {
		     $nn[] = $data[0];
		}
		fclose($file);
		var_dump($nn);
		
		$rand = rand(0, count($nn)-1);
		$nick = $nn[$rand];
		//echo $nick;
		
		
		$headfile = fopen(storage_path('app/tmp/headimg.txt'), "r");
		$hh = [];
		while ( ($data = fgetcsv($headfile, 100, ",")) !==FALSE) {
		     $hh[] = $data[0];
		}
		fclose($headfile);
		$randhh = rand(0, count($hh)-1);
		$avatar = $hh[$randhh];
		$avatarurl = 'https://source.c8c8tv.com/headimage/' . $avatar;
		//echo $avatarurl;
		
		$u = new User();
		$data = $u->register($account, 'c8c8tv', $nick, $avatarurl, 'c8c8tv@richway.com', Utils::getIp(), 0, 1);
		return $data;
	}
	
	public function callback(Request $request) {
	}

	function utf8_str_split($str, $split_len = 50) 
	{ 
	
	    if (!preg_match('/^[0-9]+$/', $split_len) || $split_len < 1) 
	        return FALSE; 
	  	
	    $len = mb_strlen($str, 'UTF-8'); 
	    if ($len <= $split_len) 
	        return array($str); 
	    preg_match_all('/.{'.$split_len.'}|[^x00]{1,'.$split_len.'}$/us', $str, $ar); 
	
	    return $ar[0]; 
	
	} 

}
