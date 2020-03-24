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

use FFMpeg\FFMpeg;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;
use Intervention\Image\Font;

use Illuminate\Http\File;
use App\Lib\StrFilter;

class Upload2Controller extends Controller {

	public function store(Request $request) {
	    $this->validate($request, [
	        'video' => 'max:50000',
	        'img' => 'mimes:jpeg,jpg,png,gif|max:10000',
	        'userid' => 'required',
	        'type' => 'required',
	        //'tag' => 'required',
	        'content' => 'required|max:300'
	        
	    ]);
	    
	    var_dump($request->input('tags'));
	    
		return response()->json([
			    'ret' => 0,
			    'msg' => '中斷節點'
		]); 

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
	    
		$post = new PostsArticle();
		
		$disk = \Storage::disk('gcs');
		$localdisk = \Storage::disk('public');
		
	    switch ($request->type) {

		    case 3: //影片
				$file = $request->file('video');
				$ext = $file->getClientOriginalExtension();
							
							
				$ffmpeg = FFMpeg::create([
				    'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
				    'ffprobe.binaries' => '/usr/bin/ffprobe',
				    'timeout'          => 3600, // The timeout for the underlying process
				    'ffmpeg.threads'   => 4,   // The number of threads that FFMpeg should use
				]);					
				

				$filename = date('Ymdis') . '-' . $user['USER_ID'] . '-' . 'x264';
		        $path = '/upvideo/' . date('Y') . '/' . date('m');
		        
		        //$file->move(public_path().$path, $filename);
		        /*
				$video = $ffmpeg->open($file);							
				$video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(30))
					  ->save('/www/www.lyvideo168.com/public'.$path.'/'. $filename.'.jpg');
				*/				
							
				//new		
				//$filename = date('Ymdis') . '-' . $user['USER_ID'] . '-' . 'x264';
		        //$path = '/upvideo_tmp/' . date('Y') . '/' . date('m');
		        
		        //$file->move(public_path().$path, $filename);			

				//儲存封面
				$disk->putFileAs($path, new File('/www/www.lyvideo168.com/public'.$path .'/'. $filename.'.jpg'), $filename . '.jpg' , 'public');
				$imfileexist = $disk->exists($path . '/' . $filename . '.jpg');

				$disk->putFileAs($path, new File($file), $filename . ".$ext" , 'public');
				$vfileexist = $disk->exists($path . '/' . $filename . ".$ext");	
				
				//unlink(public_path() . $path .'/'. $filename.'.jpg');
				//$publicdisc = \Storage::disk('public');
				//$publicdisc->delete([$path .'/'. $filename.'.jpg', $path .'/'. $filename.'.mp4']);
				
				if($vfileexist) {
					//$post->cover_img = 'https://storage.googleapis.com/c8av'. $path . '/' . $filename . '.jpg';
					$post->video_url = 'https://storage.googleapis.com/c8av'. $path . '/' . $filename . ".$ext"; //影片
					$post->covered = 1;
					//$post->video_len = intval($duration);					
				} else {
					return response()->json([
					    'ret' => -1,
					    'msg' => '上傳失敗!'
					]); 					
				}
		    	break;
	    }
		
		
		$post->user_id = $user['USER_ID'];
		$post->cate_id = $request->type;
		//$post->title = preg_replace('!\s+!', ' ', trim(strip_tags($request->content)));
		$post->title = preg_replace('!\s+!', ' ', strip_tags(nl2br($request->content), '<br /><br>'));


		$post->created_time = date('Y-m-d h:i:s');

		$sf = new StrFilter();
		if($sf->chktext($request->content)) {
			$post->status = 1; //預設審查
		} else {
			$post->status = 0; //預設審查
		}		
		
		//$post->status = 1; //預設審查
		$post->save();
		
		$insertedId = $post->id;
		
		/*
		$pd = new PostsDetail();	
		$pd->id = $insertedId;
		$pd->count_digg = rand('700', '2500');  //暫時
		$pd->count_bury = rand('80', '450');	 //暫時
		$pd->save();
		*/

		$pc = new PostsCategory();
		$pc->find($request->type)->increment('article_nums');
		
		//新增post relation
		$tagStatus = 1;
		if($request->type == 3) {
			$tagStatus = 0;
		}
		PostsTagRelationships::create(['post_id' => $insertedId, 'post_tag_id' => $request->tag, 'cate_id' => $request->type, 'status' => $tagStatus]);		
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