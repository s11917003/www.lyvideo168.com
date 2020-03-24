<?php
namespace App\Http\Controllers\Api;
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


class FormUpload2 extends Controller {
		
	public function getData(Request $request) {
	    
	    $this->validate($request, [
	        //'video' => 'max:50000',
	        //'file' => 'mimes:jpeg,jpg,png,gif|max:10000',
	        'userId' => 'required',
	        'posttype' => 'required',
	        'text' => 'required|max:300',
			'tag' => 'required',
	        
	    ]);		
		//\Log::info($request->all());
		$post = new PostsArticle();
		$disk = \Storage::disk('gcs');
		$localdisk = \Storage::disk('public');

		switch ($request->posttype) {
			 case 1:	//段子
			 	$text = preg_replace('!\s+!', ' ', trim(strip_tags($request->text)));
			 	$tt = $this->mb_chunk_split($text, 25, "\n\n"); 

				$img = \Image::make(public_path('/upimage/share-bg.png'));
			    $img->text($tt, 100, 200, function($font) {  
			        $font->file(public_path('/upimage/KaiGenGothicTW-Bold.ttf'));  
			        $font->size(40);
			        $font->color('#000000');  
			        $font->align('left');  
			        $font->valign('bottom');  
			        //$font->angle(90);
			    });

				$filename = date('Ymdis') . '-' . $request->userId . '-' . 'img';
				$path = '/upimage/' . date('Y') . '/' . date('m');

				//$img->save(public_path('/upimage/' .$filename . '.jpg'));
				$disk->put($path . '/' . $filename . '.jpg' , (string) $img->encode());

				//$disk->putFileAs($path, $img, $filename . '.jpg', 'public');
				$file = $disk->exists($path . '/' . $filename . '.jpg');
				
				if($file) {
					$post->share_fb_img = 'https://source.c8c8tv.com'. $path . '/' . $filename . '.jpg';
					$post->covered = 1;
				} else {
					return response()->json([
					    'result' => -1,
					    'msg' => '上傳失敗!'
					]); 					
				}			    			 	

			 break;
			 case 2: //圖片			 	
				$file = $request->file('photo0');
				
				$filename = date('Ymdis') . '-' . $request->userId . '-' . 'img';
				$ext = $file->getClientOriginalExtension();

				$path = '/upimage/' . date('Y') . '/' . date('m');
				//$file->move(public_path().$path, $filename . '.' . $ext);
				
				$disk->putFileAs($path, $file, $filename . '.' . $ext, 'public');
				$gcpfile = $disk->exists($path . '/' . $filename . '.' . $ext );

				//gif 靜態圖
				if($ext == 'gif') {					
					$newpng = "/www/www.c8c8tv.com/storage/app/public/upimage/tmp/".$filename.".jpg";
					$jpgimg = imagejpeg(imagecreatefromgif($file), $newpng);
					
					$disk->putFileAs($path, new File($newpng), $filename . '.jpg', 'public');
					$coverfile = $disk->exists($path . '/' . $filename . '.jpg');
					$post->cover_img = 'https://source.c8c8tv.com'. $path . '/' . $filename . '.jpg';
					$localdisk->delete("upimage/tmp/".$filename.".jpg");				        
				} else {
					$post->cover_img = 'https://source.c8c8tv.com'. $path . '/' . $filename . '.' . $ext;
				}					
				
								
				if($gcpfile) {
					//$post->cover_img = 'https://source.c8c8tv.com'. $path . '/' . $filename . '.jpg';
					$post->video_url = 'https://source.c8c8tv.com'. $path . '/' . $filename . '.' . $ext; //影片
					$post->covered = 1;
				} else {
					return response()->json([
					    'result' => -1,
					    'msg' => '上傳失敗!'
					]); 					
				}
			break;
		    case 3: //影片
				$file = $request->file('photo0');
				//\Log::info($file)
				$ext = $file->getClientOriginalExtension();
							
				$filename = date('Ymdis') . '-' . $request->userId . '-' . 'x264';
		        $path = '/upvideo_tmp/' . date('Y') . '/' . date('m');

				$disk->putFileAs($path, new File($file), $filename . ".$ext" , 'public');
				$vfileexist = $disk->exists($path . '/' . $filename . ".$ext");	
								
				if($vfileexist) {
					$post->video_url = 'https://source.c8c8tv.com'. $path . '/' . $filename . ".$ext"; //影片
					$post->covered = 0;
					//$post->video_len = intval($duration);					
				} else {
					return response()->json([
					    'ret' => -1,
					    'msg' => '上傳失敗!'
					]); 					
				}
		    break;			
		}

		$post->user_id = $request->userId;
		$post->cate_id = $request->posttype;
		$post->title = preg_replace('!\s+!', ' ', trim(strip_tags($request->text)));

		$post->created_time = date('Y-m-d h:i:s');

		$sf = new StrFilter();
		if($sf->chktext($request->text)) {
			$post->status = 1; //預設審查
		} else {
			$post->status = 0; //預設審查
		}		
		
		//$post->status = 1; //預設審查
		$post->save();
		$insertedId = $post->id;
		
		$pd = new PostsDetail();	
		$pd->id = $insertedId;
		$pd->count_digg = rand('200', '1200');  //暫時
		$pd->count_bury = rand('20', '150');	 //暫時
		$pd->save();

		$pc = new PostsCategory();
		$pc->find($request->posttype)->increment('article_nums');

		$tagStatus = 1;
		if($request->posttype == 3) {
			$tagStatus = 0;
		}
		//新增post relation
		PostsTagRelationships::create(['post_id' => $insertedId, 'post_tag_id' => $request->tag, 'cate_id' => $request->posttype ,'status' => $tagStatus]);		
				
		return response()->json([
			'result'=> 1,
		    'msg' => '上傳成功，請等待審查!',
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