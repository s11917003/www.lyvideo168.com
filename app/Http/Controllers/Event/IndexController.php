<?php
namespace App\Http\Controllers\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google\Cloud\Storage\StorageClient;

class IndexController extends Controller {
	
	public function download() {
    	return view('event.download.index_en');
	}

	public function downloadtw() {
    	return view('event.download.index');
	}
	
	public function apkdownload(Request $request) {
		if(@$request->input('pkgname') == 'sex.gporn.apk') {
			//$url = 'app/apk/sex-gporn_1_0_0.apk';
		} else {
			$url = 'app/apk/app-release_1_0_4.apk';
			//return ;
		}
		
		$signed = $this->signUrl($url);
		//echo $signed;
		header("Location:$signed");
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
	
}