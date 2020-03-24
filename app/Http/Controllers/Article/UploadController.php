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
				
				$sec = $ffprobe->format($file)  // extracts streams informations
							->get('duration');// returns the duration property
				
				$sec = floor($sec) - $cuttime - $cuttime2;				
				$timecode = gmdate("H:i:s", $sec);

				$filename = date('Ymdis') . '-' . 4 . '-' . 'x264';
		        $path = '/upvideo/' . date('Y') . '/' . date('m');		        
		        
			
				//儲存影片
				$disk->putFileAs($path, new File($file), $filename . '.mp4' , 'public');
				$vfileexist = $disk->exists($path . '/' . $filename . '.mp4');
				
				
				if($vfileexist) {
					$post->video_url = storage_path($filename.'.mp4'); //影片			
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
		$post->folder = $path .'/'. $filename;
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