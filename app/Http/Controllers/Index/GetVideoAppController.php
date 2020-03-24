<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\PostsArticle;
use App\Model\PostsDetail;
use Chrisyue\PhpM3u8\M3u8;
use Cookie;
use Google\Cloud\Storage\StorageClient;


class GetVideoAppController extends Controller {
	public function index(Request $request, $id) {
		header("Content-Type: audio/mpegurl");
		header("Content-Disposition: attachment; filename=playlist.m3u");		
		
		$article = PostsArticle::find($id);
		$m3u8Url = $article->video_url;

		PostsDetail::find($id)->increment('count_view');
		//echo $m3u8Url;
		$path = str_replace('http://35.227.193.144/', '', $m3u8Url);
		//echo $path;
		
		$url = $this->signUrl($path);
		$arrContextOptions=[
			"ssl"=>[
		            "verify_peer"=>false,
		            "verify_peer_name"=>false,
		        ],
		]; 	
		
		$m3u8text = file_get_contents($url, false, stream_context_create($arrContextOptions));
		//echo $m3u8text;
				
		$m3u8 = new M3u8();
		$m3u8->read($m3u8text);
		$count = $m3u8->getSegments()->count();
		
		$urlstring = str_replace('.m3u8', '', $path);
		for ($i=0; $i < $count; $i++) {
			$path =  $urlstring . $i . '.ts';
			$urlts = $this->signUrl($path);
			$m3u8->getSegments()[$i]->getUri()->setUri($urlts);
		}
		
		echo $m3u8->dump();
		
	}
	
	private function signUrl($path) {
		$ts = time() + 3600;
		$storage = new StorageClient([
		    'projectId' => 'c8c8tv-198006',
		    'keyFilePath' =>'/www/www.lyvideo168.com/c8c8tv-37049b748066.json'
		]);
		$bucket = $storage->bucket('source.gporn.cc');
		$object = $bucket->object($path);
		$url = $object->signedUrl($ts);		
		$url = str_replace('https://storage.googleapis.com/source.gporn.cc', 'https://source.gporn.cc', $url);
		
		return $url;
	}
	
	private function encryptIt( $q ) {
	    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}

	private function decryptIt( $q ) {
	    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}
}