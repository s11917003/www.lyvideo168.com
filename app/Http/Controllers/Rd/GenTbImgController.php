<?php

namespace App\Http\Controllers\Rd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\Utils;
use Carbon\Carbon;

use App\Model\PostsArticle;


use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Google\Cloud\Storage\StorageClient;
use \Gumlet\ImageResize;


class GenTbImgController extends Controller {	
	
	public function index() {		
		
		for ($i=0; $i < 10; $i++) {
		$data = PostsArticle::whereNotNull('cover_img')->where('tb_img', '')->first();
		if($data == null) {
			echo 'done';		
			return ;
		}
		$url = $data->cover_img;
		$urlexplo = explode('/', $url);
		
		//$url = 'https://source.gporn.cc/upvideo/2018/08/201808304128-4-x264/201808304128-4-x264.jpg';
		$img = '/www/www.gporn.cc/public/upimage/newtest.jpg';    
		file_put_contents($img, file_get_contents($url));    
		
		$image = new \Imagick( $img );
		$imageprops = $image->getImageGeometry();
		if ($imageprops['width'] <= 200 && $imageprops['height'] <= 200) {
		    // don't upscale
		} else {
		    $image->resizeImage(200,200, \imagick::FILTER_LANCZOS, 0.9, true);
		}
		
		file_put_contents($img, $image);
		$disk = \Storage::disk('gcs');
		$disk->putFileAs($data->folder, new File($img), $urlexplo[6].'-tb' . '.jpeg' , 'public');
		unlink($img);
		
		//更新db
		$p = PostsArticle::find($data->id);
		$p->tb_img = 'https://source.gporn.cc'. $data->folder . '/' . $urlexplo[6].'-tb' . '.jpeg';
		$p->save();

		echo 'done';
		}
	}
}