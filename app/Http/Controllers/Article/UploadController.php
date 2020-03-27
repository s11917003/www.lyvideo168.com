<?php
namespace App\Http\Controllers\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Lib\User;
use App\Model\PostsArticle;
use App\Model\PostsDetail;
use App\Model\PostsCategory;
use App\Model\PostsTag;
use App\Model\PostsTagRelationships;
 
use Pbmedia\LaravelFFMpeg\FFMpegFacade  as FFMpeg;
use FFMpeg\Format\Video\X264 as X264;

use Intervention\Image\ImageManager;
use Intervention\Image\Image;
use Intervention\Image\Font;

use Illuminate\Http\File;
use App\Lib\StrFilter;
use App\Lib\MimeReader;


class UploadController extends Controller {

	public function store(Request $request) {
		//\Log::info('fileType', [$request->file('video')->getMimeType()]);

	    $this->validate($request, [
	        //'video' => '|max:500000',
	        //'img' => 'mimes:jpeg,jpg,png,gif|max:10000',
	        //'userid' => 'required',
	        'type' => 'required',
	        //'tag' => 'required',
	        'content' => 'required|max:300'
	    ]);	
	    	    
	    /*
		return response()->json([
			    'ret' => 0,
			    'msg' => '中斷節點'
		]);
		*/ 	
		
		/*
	    $u = new User();
	    $user = $u->checkLogin();
	    if($user == false) {
		    //$this->msg(0, '哥哥請您先登入');
			return response()->json([
			    'ret' => 0,
			    'msg' => '哥哥請您先登入'
			]); 			       
	    }

	    if($request->userid != $user['USER_ID']) {
			return response()->json([
			    'ret' => 0,
			    'msg' => '哥哥請您先登入'
			]); 	    
	    }
	    */
		$cuttime = $request->cuttime;
		$cuttime2 = $request->cuttime2;
	
		$post = new PostsArticle();
		$disk = \Storage::disk('local');
	    switch ($request->type) {
		    case 3: //影片
				$file = $request->file('video');
				
				//取得影片長度
				$ffprobe = \FFMpeg\FFProbe::create([
					'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe'
				 
				]);
				//取得影片長度
				$ffmpeg  = \FFMpeg\FFMpeg::create([
					'ffmpeg.binaries' => ('C:/ffmpeg/bin/ffmpeg.exe'),
					'ffprobe.binaries' => ('C:/ffmpeg/bin/ffprobe.exe'),
					'timeout' => 3600,
					'ffmpeg.threads' => 12
				]);


			
				$sec = $ffprobe->format($file)  // extracts streams informations
							->get('duration');// returns the duration property
				
				$sec = floor($sec) - $cuttime - $cuttime2;				
				$timecode = gmdate("H:i:s", $sec);

				$filename = date('Ymdis') . '-' . 4 . '-' . 'x264';
			
				$pathD=  date('Y') . '/' . date('m'). '/' . $filename;	
				$path = '/public/upvideo/' .$pathD;	
			    $pathImg = '/public/upimage/' .$pathD;		       
				//儲存影片
				$disk->putFileAs($path, new File($file), $filename . '.mp4' , 'public');
				$vfileexist = $disk->exists($path . '/' . $filename . '.mp4');
				if($vfileexist) {
					$post->video_url = $pathD  . '/' . $filename . '.m3u8'; //影片
					$lowBitrate = (new X264)->setKiloBitrate(250);
					$midBitrate = (new   X264)->setKiloBitrate(500);
					$highBitrate = (new   X264)->setKiloBitrate(1000);
					$format = new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264');
					$format->on('progress', function ($video, $format, $percentage) {
						echo "$percentage % transcoded";
					});
FFMpeg::fromDisk('local')
    ->open('SampleVideo_1280x720_1mb.mp4')
    ->exportForHLS()
 
	->informat(new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
    ->save('adaptive_steve.m3u8');
					return;
					// /*   切m3u8檔案  */
					// $video = $ffmpeg->open($file);
					// $disk->makeDirectory($pathImg);
					// // 在视频一半的地方截圖
					// $frame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(intval($sec/2)));
					// $frame->save(storage_path().'/app'.$pathImg.'/'.$filename.'.jpg'); 
				 
					// $post->cover_img =  '/upvideo'.$pathD  . '/' . $filename . '.jpg'; //截圖
					// $post->tb_img =  '/upvideo'.$pathD  . '/' . $filename . '.jpg'; //截圖
					
				
					// // $video->save(new \FFMpeg\Format\Video\X264() ,storage_path().'/app'.$path.'/'.$filename.'.m3u8');
					// $format = new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264');
					// $format->on('progress', function ($video, $format, $percentage) {
					// 	echo "$percentage % transcoded";
					// });
					// $video->filters()->watermark(public_path('/img/120.png'), array(
					// 	'position' => 'absolute',
					// 	'x' => 1180,
					// 	'y' => 620,
					// ));
					// // //$video->setSegmentLength(4); // optional
					// $video->save($format ,storage_path().'/app'.$path.'/'.$filename.'.m3u8');
				} else {
					return response()->json([
					    'ret' => -1,
					    'msg' => '上傳失敗!'
					]); 					
				}
		    	break;
	    }
		
		$post->user_id = 4;
		$post->cate_id = $request->type;
		$post->folder =  $pathD;
		$post->title = preg_replace('!\s+!', ' ', strip_tags(nl2br($request->content), '<br /><br>'));
		$post->created_time = date('Y-m-d h:i:s');
		$post->hd = $request->hd;
		$post->video_len = $timecode;
		$post->cuttime = $cuttime;
		
		$sf = new StrFilter();
		if($sf->chktext($request->content)) {
			$post->status = 1; //預設審查
		} else {
			$post->status = 0; //預設審查
		}
		
		$post->status = 1; //預設審查
		$post->covered = 0;
		$post->save();
		
		 
		$insertedId = $post->id;
		
		$pd = new PostsDetail();	
		$pd->id = $insertedId;
		//$pd->count_digg = rand('50', '350');  //暫時
		//$pd->count_bury = rand('10', '150');	//暫時
		$pd->save();

		$pc = new PostsCategory();
		$pc->find($request->type)->increment('article_nums');
		
		//新增post relation
		$tags = explode(',',$request->input('tags'));
		$tagsdata = [];
		foreach ($tags as $tag) {
			$tagsdata[] =  ['post_id'=> $insertedId, 'post_tag_id'=> $tag];
 		}
		
		PostsTagRelationships::insert($tagsdata); // Eloquent approach	

		return response()->json([
		    'ret' => 1,
		    'msg' => '上傳成功，請等待審查!',
		    'file' => $request->type
		]);
	}



	function mbStringToArray ($str) { 
	    if (empty($str)) return false; 
	    $len = mb_strlen($str); 
	    
	    $array = []; 
	    for ($i = 0; $i < $len; $i++) { 
	        $array[] = mb_substr($str, $i, 1); 
	    } 
	
	    return $array; 
	} 

	function mb_chunk_split($str, $len, $glue) { 
	    if (empty($str)) return false; 
		    $array = $this->mbStringToArray ($str); 
	    $n = 0;
	    $i = 0;
	    $new = ''; 
	    foreach ($array as $char) {
		    if($i > 100) {
			    $new .= '...';
			    break;
		    } 
		    //echo $n . '<br>';
	        if ($n < $len) $new .= $char; 
		        elseif ($n == $len) { 
	            $new .= $glue . $char; 
		            $n = 0; 
	        }
	        $n++;
	        $i++;
		} 
	    return $new; 
	} 	
	
}