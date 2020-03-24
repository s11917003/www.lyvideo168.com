<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\PostsArticle;
use Chrisyue\PhpM3u8\M3u8;
use Cookie;

class GetVideoController extends Controller {
	public function index($id) {
		
		$refer = \Request::server('HTTP_REFERER');
		/*
		if($refer == '') {
			//echo $refer;
			return ;
		}
		*/
		
		/*		
		if (strpos($refer, 'gporn.cc') === FALSE && strpos($refer, 'caca01.com') === FALSE) {
			echo $refer;
			return;
		}
		*/				
		
		//header('Access-Control-Allow-Origin: http://av.caca01.com'); 
		header("Content-Type: audio/mpegurl");
		header("Content-Disposition: attachment; filename=playlist.m3u");
		
		$article = PostsArticle::find($id);
		$m3u8Url = $article->video_url;
		$folderUrl = $article->folder;
		$expirtime = time()+3600;
//		exec("python3.4 /www/www.c8c8tv.com/python/signedCdnUrl.py $m3u8Url $expirtime 'm3u8' 0", $m3u8o);

		$arrContextOptions=[
			"ssl"=>[
		            "verify_peer"=>false,
		            "verify_peer_name"=>false,
		        ],
		];
		//echo $m3u8Url;
		
		$m3u8text = file_get_contents(public_path() . '/upvideo/' . $m3u8Url, false, stream_context_create($arrContextOptions));

		$m3u8 = new M3u8();
		$m3u8->read($m3u8text);
		
		
		$count = $m3u8->getSegments()->count();
		
		//var_dump($m3u8->getSegments()[0]->getUri());
		/*
		$urlstring = str_replace('.m3u8', '', $m3u8Url);
		//exec("python3.5 /www/www.lyvideo168.com/python/signedCdnUrl.py $urlstring $expirtime 'ts' $count", $output);
		//$tsstring = str_replace('[','',$output[0]);
		//$tsstring = str_replace(']','',$tsstring);
		//$tsstring = str_replace("'",'',$tsstring);
		$arr = explode(',', $tsstring);
		*/
		
		for($i=0; $i<$count; $i++) {
			$uri = $m3u8->getSegments()[$i]->getUri();
			
			$m3u8->getSegments()[$i]->getUri()->setUri(url('/') . '/upvideo/' . $folderUrl . '/' . $uri);
			
			// original
			//$m3u8->getSegments()[$i]->getUri()->setUri('http://lyvideo168.com/upvideo/post/' . $uri);
		}
		
		echo $m3u8->dump();
	}
	
	private function getSslPage($url,$timeout=30,$header=array()) {
        if (!function_exists('curl_init')) {
            throw new Exception('server not install curl');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        $data = curl_exec($ch);
        list($header, $data) = explode("\r\n\r\n", $data);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 301 || $http_code == 302) {
            $matches = array();
            preg_match('/Location:(.*?)\n/', $header, $matches);
            $url = trim(array_pop($matches));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $data = curl_exec($ch);
        }

        if ($data == false) {
            curl_close($ch);
        }
        @curl_close($ch);
        return $data;
	}
}