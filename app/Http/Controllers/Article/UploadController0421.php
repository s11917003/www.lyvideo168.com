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
 
// use Pbmedia\LaravelFFMpeg\FFMpegFacade  as FFMpeg;
// use FFMpeg\Format\Video\X264 as X264;
use FFMpeg\FFMpeg;
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


				if($sec<=0){
					return response()->json([
						'ret' => -1,
						'msg' => '影片长度有误，请重新输入'
					]); 
				}
				$start = gmdate("H:i:s",$cuttime);	
				$end = gmdate("H:i:s", floor($sec) + $cuttime);	
			
			 
				$filename = date('Ymdis') . '-' . 4 . '-' . 'x264';
			
				$pathD=  date('Y') . '/' . date('m'). '/' . $filename;	
				$path = '/public/upvideo/' .$pathD;	
			    $pathImg = '/public/upimage/' .$pathD;		       
				//儲存影片
				$disk->putFileAs($path, new File($file), $filename . '.mp4' , 'public');
				$vfileexist = $disk->exists($path . '/' . $filename . '.mp4');
				if($vfileexist) {
					$post->video_url = $pathD  . '/' . $filename . '.m3u8'; //影片
 
					set_time_limit(0);
					//轉檔 浮水印

					
					//裁剪視頻
					// var_dump("ffmpeg -i ".storage_path().'/app'.$path.'/'.$filename.'.mp4'." -ss ".$start." -c copy -t ".$timecode." ".storage_path().'/app'.$path.'/'.$filename.'1.mp4');
					shell_exec("ffmpeg -i ".storage_path().'/app'.$path.'/'.$filename.'.mp4'." -ss ".$start." -c copy -t ".$end." ".storage_path().'/app'.$path.'/'.$filename.'1.mp4');
					shell_exec("ffmpeg -i ".storage_path().'/app'.$path.'/'.$filename.'1.mp4'." -profile:v baseline -b:v 1200k -maxrate 1200k -b:a 41k -start_number 0 -hls_time 20 -hls_list_size 0 -vf \"drawtext=fontfile=Microsoft YaHei Mono.ttf:text='lygj16888.com':y=line_h:x=W-w:fontsize=10:fontcolor=yellow:shadowx=1:shadowy=1\""." -codec:v libx264 -codec:a copy -y -f hls ".storage_path().'/app'.$path.'/'.$filename.'.m3u8');
					$disk->makeDirectory($pathImg);
					// // 在视频一半的地方截圖
					unlink(storage_path().'/app'.$path.'/'.$filename.'.mp4');
					unlink(storage_path().'/app'.$path.'/'.$filename.'1.mp4');
					$video = $ffmpeg->open($file);
					$frame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(intval($sec/2)));
					$frame->save(storage_path().'/app'.$pathImg.'/'.$filename.'.jpg'); 
				 
					$post->cover_img =  '/upimage/'.$pathD  . '/' . $filename . '.jpg'; //截圖
					$post->tb_img =  '/upimage/'.$pathD  . '/' . $filename . '.jpg'; //截圖
					
				} else {
					return response()->json([
					    'ret' => -1,
					    'msg' => '上傳失敗!'
					]); 					
				}

				$file1 = $request->file('video1');
			
		    	break;
	    }
		
		$post->user_id = 4;
		$post->cate_id = $request->type;
		$post->folder =  $pathD;
		$post->title = preg_replace('!\s+!', ' ', strip_tags(nl2br($request->content), '<br /><br>'));
		$post->created_time = date('Y-m-d h:i:s');
		$post->hd = $request->hd;
		$post->video_len = $timecode;
		$post->cuttime = 60;
		$post->covered = 1;
		
		$sf = new StrFilter();
		if($sf->chktext($request->content)) {
			$post->status = 1; //預設審查
		} else {
			$post->status = 0; //預設審查
		}
		
		$post->status = 1; //預設審查
		$post->covered = 1;
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