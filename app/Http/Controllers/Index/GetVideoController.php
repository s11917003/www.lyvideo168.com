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

		$arrContextOptions=[
			"ssl"=>[
		            "verify_peer"=>false,
		            "verify_peer_name"=>false,
		        ],
		];
		
		$m3u8text = file_get_contents(public_path() . '/storage/upvideo/' . $m3u8Url, false, stream_context_create($arrContextOptions));
		$m3u8 = new M3u8();
		$m3u8->read($m3u8text);
		
		$count = $m3u8->getSegments()->count();
		
		for($i=0; $i<$count; $i++) {
			$uri = $m3u8->getSegments()[$i]->getUri();
			$m3u8->getSegments()[$i]->getUri()->setUri(url('/') . '/storage/upvideo/' . $folderUrl . '/' . $uri);
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