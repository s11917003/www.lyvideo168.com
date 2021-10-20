<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Pagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use illuminate\database\eloquent\collection;
use App\Model\PostsArticle;
use App\Model\PostsCategory;
use App\Model\PostsDetail;
use App\Model\PostsTag;
use App\Model\Users;
use App\Model\PostsDigg;
use App\Model\AdDetailBanner;
use App\Model\Device;
use App\Model\Footer;
use App\Model\AdTag;
use App\Model\Announcement;
use App\Model\PostsTagRelationships;
use App\Model\Video;
use App\Model\Video_actress_name;
use App\Model\Video_tag_relations;
use App\Model\Video_tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
//  use App\Lib\User;
use App\Lib\Utils;
use Cookie;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
class IndexController extends Controller {	
	
	protected $language = ['zh'=>1 ,'en'=>2 ,'jp'=>3];
 	// public function index($page = 1) {

    //    	// $value = @$_COOKIE['appdl'];
	//    	// if($value == true) {
	// 	//    	header('Location:/event/app/en');
	// 	//    	return ;
	//    	// }


    //    	// $value = @$_COOKIE['agevarify'];
	//    	// if($value != true) {
	// 	//    	header('Location:/warning');
	// 	//    	return ;
	//    	// }   	
		   
	// 	$device = Utils::chkdevice();
	// 	$value = @$_COOKIE['appdl'];
	//    	if($value != true) {
	// 		Cookie::make('appdl',true,180);
	// 		$deviveArr  =['web' =>1 ,'android'=>2,'ios'=>3];
		 
	// 	   if(is_Null($deviveArr[$device])){	 
	// 		$d = Device::find(4);
	// 		$d->count +=1;
	// 		$d->save();
	// 	   } else { 
	// 		$d = Device::find($deviveArr[$device]);
	// 		$d->count +=1;
	// 		$d->save();
	// 	   }
	//    	} 
	//  	$category = PostsCategory::all();
	// 	$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->with('commentsGod')->where('cate_id', 3)->where('status', 1)->where('covered', 1)->orderBy('id', 'desc')->Paginate(21, null, 1, $page);
	 
	// 	$lastPage = $posts->lastPage();
	// 	$currentPage = $posts->currentPage();
	    
	//     $tagarr = [1,2,4,10,11];
	// 	$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(10)->get();	 		
	
	// 	$relate1 = $relate;
	// 	$posts1 = $posts;
	// 	$adDetail = AdDetailBanner::inRandomOrder()->where('type', 'video')->where('status',1)->limit(3)->get();
	// 	$adHalf = AdDetailBanner::inRandomOrder()->where('type', 'half')->where('status',1)->limit(1)->get();
	// 	$adFloat = AdDetailBanner::inRandomOrder()->where('type', 'float')->where('status',1)->first();
	// 	$announcement =Announcement::inRandomOrder()->where('status',1)->first();
	// 	$marquee =Announcement::inRandomOrder()->where('status',2)->first();
	// 	$hot = PostsDetail::with('hot')->orderBy('count_view', 'desc')->Paginate(10, null, 1, $page);
	// 	$footer =footer::all();	 
	// 	$adTag = AdTag::where('status',1)->get();
	// 	$now = date('Y-m-d H:i:s');
	// 	$adlog = [];

	 
	// 	foreach ($adDetail as  $key => $ad) {
	// 		if($ad->play_url){
	// 			$tagArr =  explode(',', $ad->play_url);
  	//             $tagData = [];	
	// 			foreach ($tagArr  as $tagA) {
	// 				foreach ($adTag as $tag) {
	// 					if($tag->id == $tagA){
	// 						$tagData[] = $tag;	
	// 						break;
	// 					}
	// 				}
	// 			}
	// 			$adDetail[$key]['tagData'] = $tagData;
	// 		}
	// 	}
	
	// 	if($adFloat){
	// 		$log =  ['ad_id' => $adFloat->id ,'actiontype' =>0,'updated_at'=>$now] ;
	// 		$adlog[]  = $log;
	// 	}
	// 	if(count($relate1) >0){
	// 		foreach ($adHalf as $ad) {
	// 			$log =  ['ad_id' => $ad->id ,'actiontype' =>0,'updated_at'=>$now] ;
	// 			$adlog[]  = $log;
	// 			$ad->isAd  = true;
	// 			$this->array_insert($relate1,rand(0,count($relate1)-1),$ad);
				
	// 		}
	// 	}
		
	// 	if(count($posts1) >0){
	// 		foreach ($adDetail as $ad) {
	// 			$log =  ['ad_id' => $ad->id ,'actiontype' =>0,'updated_at'=>$now] ;
	// 			$adlog[]  = $log;;
	// 			$ad->isAd  = true;
	// 			$this->array_insert($posts1,rand(0,count($posts1)-1),$ad);
	// 		}
	// 	}

	 
	// 	$announcementArr = [];
	// 	if($announcement){
	// 		$announcementArr = explode(':', $announcement->text);
	// 	}
	// 	$marqueeArr = [];
	// 	if($marquee){
	// 		$marqueeArr = explode(':', $marquee->text);
	// 	}
		
	// 	if(count($adlog) >0){
	// 		DB::table('ad_detail_banner_log')->insert($adlog);
	// 	}
		 
	 
	// 	return  view('app_rwd.index.default', [
	// 		'adHalf'=>$adHalf,
	// 		'footer'=>$footer,
	// 		'adFloat' => $adFloat,
	// 		'category'=>$category,
	// 		'posts'=>$posts1,
	// 		'lastPage' =>  $lastPage,
	// 		'currentPage' => $currentPage,
	// 		'device' => $device,
	// 		'relate' => $relate1,
	// 		'loadmore' => true,
	// 		'hot' => $hot,
	// 		'marquee' => $marqueeArr,
	// 		'announcement' => $announcementArr,
	// 		'path' =>  env('APP_URL').'app/public',		
	// 		'adTag' => $adTag,
	// 	]);
	// }
	 
	public function loadmore($page = 2) {
		$category = PostsCategory::all();
		$posts = PostsArticle::with('detail')->with('userInfo')->where('status', 1)->where('covered', 1)->orderBy('id', 'desc')->Paginate(10, null, 1, $page);
		$lastPage = $posts->lastPage();
		
		return response()->json([
			'posts' => $posts
		]);
	}

	
	
	public function image(Request $image, $img) {
	//	$img = '070221-001#羽海野まお#1.jpg';
	
		$video_id = explode("$",$img)[0];
	
		$path = 'thumbnail_img/'.$video_id .'/';
		$image = $path.$img.'.jpg';
        abort_if(
            ! \Storage::disk('public')->exists($image),
            404,
            "The file doesn't exist. Check the path."
        );
		return response()->file(\Storage::disk('public')->path($image));
		// $contents =  \Storage::disk('public')->path($image);
		// return 	$contents ;
		//  return Image::make(storage_path('/app/public/' .$image))->response();

	}
	public function index() {
		$video1 = Video::where(['cate_id'=>1])->orderBy('id', 'desc')->limit(16)->get();	
		$video2 = Video::where(['cate_id'=>2])->orderBy('id', 'desc')->limit(16)->get();		
		$video3 = Video::where(['cate_id'=>3])->orderBy('id', 'desc')->limit(16)->get();	
		$video4 = Video::where(['cate_id'=>4])->orderBy('id', 'desc')->limit(16)->get();	


		return view('app_rwd.index.index',[
			'video1' => $video1,
			'video2' => $video2,
			'video3' => $video3,
			'video4' => $video4,
		]);

	 

	}
	public function postview1(Request $request, $lang, $id) {
	
		$video_id = explode("$",$id)[0];
	 
		if(!isset($this->language[$lang])) {
			//abort(404);
			header("Location:/");
			return ;
		}
	
		//主影片DATA
		$webLangIndex = $this->language[$lang];
		$video = Video::where(['video_id'=>$video_id,'video_lang'=>$webLangIndex])->first();
	
	 
		if(!$video) {
			header("Location:/");
			return ;
		} 
		$video_tag =  Video_tag_relations::where('video_id',$video_id)->with('tagName')->get();
		$video_with_actress = [];
		if($video['actress']){ 
			$actressNameArray = explode("@", $video['actress']);
			
			$queryAcrtressName = [];
			foreach ($actressNameArray as $key => $name) {
				$queryAcrtressName[] = $name;
				
				$Video_actress_name = Video_actress_name::where('sub_name', 'like', '%'.$name.'%')->value('name');//找女優 對應表
				if($Video_actress_name) {
					$queryAcrtressName[] = $$Video_actress_name;
					$actressNameArray[$key] = $Video_actress_name;//改成常用的名字
				}
			}
		 
			if(count($queryAcrtressName)==0){ //沒有女優
				$video_with_actress = [];
				$video['actress'] ='';
			} else {
				$video_with_actress = Video::query();
				$video_with_actress->where(function($query) use($queryAcrtressName){
					foreach($queryAcrtressName as $name){
						$query->orWhere('actress', 'LIKE', '%'.$name.'%');
					}
					});
				
				$video_with_actress->where('video_id','!=',$video_id);
				$video_with_actress = $video_with_actress->distinct()->get();
				$video['actress'] = implode("&", $actressNameArray);
			}
		
		}
		
	
		//預覽圖片
		if($video['thumbnail_img']){
			$video['thumbnail_img'] = explode("@",$video['thumbnail_img']);
			$path = 'thumbnail_img/'.$video['video_id'].'/';
			$video['thumbnail_img_router'] = $video['thumbnail_img'];
			if(!is_dir($path)){
				$flag = mkdir($path,0777,true);
			}
			$img_path = [];
			foreach ($video['thumbnail_img']  as $key => $url) {
				//判斷是否存在 不存在則寫入
				$filename = $video['video_id'].'$'.$video['actress'].'$'.($key+1).'.jpg';
			
				$isExists = \Storage::disk('public')->exists($path.$filename);	

			
				$img_path[] = $filename;
				if($isExists){
					continue;
				} else {

				 
					$contents = file_get_contents($url);
					\Storage::disk('public')->put($path.$filename,$contents);
					//file_put_contents('../storage/'.$path.$filename,	$contents);   
				}
			}
		 
			$video['thumbnail_img_router'] = 	$img_path;
		}
	
		$footer =footer::all();;	

		// 英	<title>{影片ID} | {女優英文名}：Watch Free Video【JavDic  censored, uncensored and amateur japanese porn】</title>
		// 中	<title>{日文影片名稱} | {女優日文名}：線上免費試看【JavDic  有碼・無碼・素人 - 日本A片資料庫】</title>
		// 日	<title>{日文影片名稱} | {女優日文名}：無料エロ動画【JavDic  修正あり・無修正・素人 - エロ動画まとめ】</title>
		
		//標籤
		$tagName = [];
		foreach ($video_tag as $tag ) {
			$tagName[] = $tag->tagName[$lang];
			$tag->tagName = $tag->tagName[$lang];
		}
	 
		////相關標籤影片
		$randTag  = Video_tag_relations::where('video_id',$video->id)->inRandomOrder()->first();
	 	$video_relation = Video::where('video_lang',$webLangIndex)->with(['tagRelations'])->whereHas('tagRelations', function($q) use ($randTag) { $q->where('tag_id', '=', $randTag->tag_id); })->limit(10)->get();		
		 
		
		$title  = $video['video_id'].'|'.$video['actress'].'無料エロ動画【JavDic  '. implode(",", $tagName).'】';
		$url = $video['video_id'].'|'.$video['actress'];
		if($video) {
			$device = Utils::chkdevice();
			return view('app_rwd.index.pview',[
				'footer'=>$footer,
				'device' => $device,
				'video' => $video, 							//主影片
				'video_with_actress' => $video_with_actress,//相關女優
				'video_tag' => $video_tag,					//標籤
				'title' =>  $title  ,						//影片title
				'video_relation' => $video_relation 		//相關標籤
			]);
		} else {
			//沒有文章跳轉
			echo '沒有文章';
		}

	}
	public function postview(Request $request, $id) {
		$article = $this->show_api($id);
		if(!$article) {
			header("Location:/");
			return ;
		}

		$viedo_id = 8;
		$video = Video::where('id', $viedo_id)->first();
		$video_with_actress = Video::query();
		$video_tag =  Video_tag_relations::where('video_id',$viedo_id)->with('tagName')->get();
		 
		if($video['actress']){
		// 	$url =  'https://www.caribbeancom.com/moviepages/070221-001/images/s/001.jpg';
		// 	$contents = file_get_contents($url);
		// //	var_dump($contents);
		// 	$name = 'test';//從url取得檔名
			
			// var_dump(file_put_contents('test1.jpg', $contents));
			$actressNameArray = explode(",", $video['actress']);
			foreach ($actressNameArray as $key => $name) {
				$video_with_actress->orWhere('actress', 'like', '%'.$name.'%');
				$Video_actress_name = Video_actress_name::where('sub_name', 'like', '%'.$name.'%')->value('name');
				if($Video_actress_name) {
					$actressNameArray[$key] = $Video_actress_name;
					$video_with_actress->orWhere('actress', 'like', '%'.$Video_actress_name.'%');
				}
			}
			$video_with_actress = $video_with_actress->distinct()->get();
			$video['actress'] = implode("&", $actressNameArray);
		}
		if($video['thumbnail_img']){

			$video['thumbnail_img'] = explode("@",$video['thumbnail_img']);
			$path = 'thumbnail_img/'.$video['video_id'].'/';
		
			$video['thumbnail_img_router'] = $video['thumbnail_img'];
			if(!is_dir($path)){
				$flag = mkdir($path,0777,true);
			}
			$img_path = [];
			foreach ($video['thumbnail_img']  as $key => $url) {
				//判斷是否存在 不存在則寫入
				$filename = $video['video_id'].'$'.$video['actress'].'$'.($key+1).'.jpg';
				$isExists = \Storage::disk('public')->exists($path.$filename);	
				$img_path[] = $filename;
				if($isExists){
					continue;
				} else {
					$contents = file_get_contents($url);
					\Storage::disk('public')->put($path.$filename,$contents);
					//file_put_contents('../storage/'.$path.$filename,	$contents);   
				}
			
			}
			$video['thumbnail_img_router'] = 	$img_path;
			
			// $image = new \Imagick( $img );
			// $imageprops = $image->getImageGeometry();
			// if ($imageprops['width'] <= 200 && $imageprops['height'] <= 200) {
			// 	// don't upscale
			// } else {
			// 	$image->resizeImage(200,200, \imagick::FILTER_LANCZOS, 0.9, true);
			// }
			
			// file_put_contents($img, $image);
			// $disk = \Storage::disk('gcs');
			// $disk->putFileAs($data->folder, new File($img), $urlexplo[6].'-tb' . '.jpeg' , 'public');
			// unlink($img);
			
			// //更新db
			// $p = PostsArticle::find($data->id);
			// $p->tb_img = 'https://source.gporn.cc'. $data->folder . '/' . $urlexplo[6].'-tb' . '.jpeg';
			// $p->save();



		}
		//add pv;
		PostsDetail::find($id)->increment('count_view');
		$postsDetail = PostsDetail::find($id);
	 
		//suggest post
		$tags = PostsTagRelationships::where('post_id', $id)->get();
		$footer =footer::all();;	
		//var_dump($tags);
		$tagarr = [];
		foreach ($tags as $tag) {
			$tagarr[] = $tag['post_tag_id'];
		}
	
		//$relate = \DB::table('posts_tag_relationships')->whereIn('post_tag_id', $tagarr)->groupBy('post_id')->inRandomOrder()->limit(6)->get();
		$relate = PostsTagRelationships::with('article')->where('post_id','!=', $id)->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(10)->get();	 		
		
		$adDetail = AdDetailBanner::inRandomOrder()->where('type', 'video')->where('status',1)->limit(2)->get();
		$adHalf = AdDetailBanner::inRandomOrder()->where('type', 'half')->where('status',1)->limit(1)->get();
		$marquee =Announcement::inRandomOrder()->where('status',2)->first();
	
		$marqueeArr = [];
		if($marquee){
			$marqueeArr = explode(':', $marquee->text);
		}
		$status = 0;
		$adlog = [];
		if (Auth::check()) {
			$user  = Auth::User();
			if ($user) {
				$postsDigg = PostsDigg::where('user_id',$user->user_id)->where('post_id',$id)->first();
				$status = $postsDigg['status'];
			}
		}
		$now = date('Y-m-d H:i:s');
		if(count($relate) >0){
			foreach ($adDetail as $ad) {
				$log =  ['ad_id' => $ad->id ,'actiontype' =>0,'updated_at'=>$now] ;
				$adlog[]  = $log;;
				$ad->isAd  = true;
				$this->array_insert($relate,rand(0,count($relate)-1),$ad);
			}
		}

		foreach ($adDetail as $ad) {
			$log =  ['ad_id' => $ad->id ,'actiontype' =>0,'updated_at'=>$now] ;
			$adlog[]  = $log;;
			$ad->isAd  = true;
		}
		
		if(count($adlog) >0){
			DB::table('ad_detail_banner_log')->insert($adlog);
		}


	
		// 英	<title>{影片ID} | {女優英文名}：Watch Free Video【JavDic  censored, uncensored and amateur japanese porn】</title>
		// 中	<title>{日文影片名稱} | {女優日文名}：線上免費試看【JavDic  有碼・無碼・素人 - 日本A片資料庫】</title>
		// 日	<title>{日文影片名稱} | {女優日文名}：無料エロ動画【JavDic  修正あり・無修正・素人 - エロ動画まとめ】</title>
		
		$tagName = [];
		foreach ($video_tag as $tag ) {
			$tagName[] = $tag->tagName['zh'];
		}
							 
					
		$title  = $video['video_id'].'|'.$video['actress'].'無料エロ動画【JavDic  '. implode(",", $tagName).'】';
		$url = $video['video_id'].'|'.$video['actress'];
		if($article) {
			$device = Utils::chkdevice();
			return view('app_rwd.index.pview',[
				// 'ad'=>$adDetail,
				'footer'=>$footer,
				'adHalf'=>$adHalf, 
				'post'=>$article,
				'device' => $device,
				'relate' => $relate,
				'postsDetail' => $postsDetail,
				'status' => $status,
				'marquee' => $marqueeArr,
				'video' => $video, 							//主影片
				'video_with_actress' => $video_with_actress,//相關女優
				'video_tag' => $video_tag,					//標籤
				'title' =>  $title  						//影片title
			]);
		} else {
			//沒有文章跳轉
			echo '沒有文章';
		}

	}
	

	public function postviewtest(Request $request, $id) {
		$article = $this->show_api($id);
		if(!$article) {
			header("Location:/");
			return ;
		}
		
		//add pv;
		PostsDetail::find($id)->increment('count_view');
		   	 		
		//suggest post
		$tags = PostsTagRelationships::where('post_id', $id)->get();
		//var_dump($tags);
		$tagarr = [];
		foreach ($tags as $tag) {
			$tagarr[] = $tag['post_tag_id'];

		}
		
		//$relate = \DB::table('posts_tag_relationships')->whereIn('post_tag_id', $tagarr)->groupBy('post_id')->inRandomOrder()->limit(6)->get();
		$relate = PostsTagRelationships::with('article')->where('post_id', '!=' ,  $id)->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(14)->get();	 		
		if($article) {
			$device = Utils::chkdevice();
			return view('app_rwd.index.pviewtest',[
				'post'=>$article,
				'device' => $device,
				'relate' => $relate
			]);
		} else {
			//沒有文章跳轉
			echo '沒有文章';
		}

	}




	public function postviewapp(Request $request, $id) {
		$article = $this->show_api($id);
		if(!$article) {
			//header("Location:/");
			return ;
		}
		
		//add pv;
		PostsDetail::find($id)->increment('count_view');
		   	 		
		//suggest post
		$tags = PostsTagRelationships::where('post_id', $id)->get();
		//var_dump($tags);
		$tagarr = [];
		foreach ($tags as $tag) {
			$tagarr[] = $tag['post_tag_id'];

		}
		
		/*
		$max = \DB::table('posts_article')->max('id');
		$numbers = range (18,$max);
		shuffle($numbers);
		$result = array_slice($numbers,0,20);
		*/		
		
		//$relate = \DB::table('posts_tag_relationships')->whereIn('post_tag_id', $tagarr)->groupBy('post_id')->inRandomOrder()->limit(6)->get();
		$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(14)->get();	 		
		if($article) {
			//$device = Utils::chkdevice();
			return view('app_rwd.appview.pview',[
				'post'=>$article,
				//'device' => $device,
				'relate' => $relate
			]);
		} else {
			//沒有文章跳轉
			echo '沒有文章';
		}

	}	

	public function show_api($id) {
	    $article = PostsArticle::with('detail')->with('tag')->with('userInfo')->where('id',$id)->where('status', 1)->first();
	    return $article;
	}
	public function category() {
		return view('app_rwd.index.category');
	}
	public function categoryPost(Request $request) {
		$video_ids =  Video_tag_relations::whereIn('tag_id',$request->tag)->pluck('id')->toArray();
		$video = Video::select('*')->whereIn('id', $video_ids)->Paginate(36) ;

		return  response()->json(['video_ids' => $video_ids, 'video' =>$video,  'pagination' => (string)$video->links("pagination::bootstrap-4"), ]);
		return $video ;

	}
	//分類
	// public function category($cat, $page = 1) {
		
	// 	$category = PostsCategory::all();
	// 	$cats = PostsCategory::where('name_en', $cat)->first();
	// 	if($cats == null) {
	// 		header("Location:/");
	// 		return ;
	// 	}		
		
	// 	$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->with('commentsGod')->where('cate_id', $cats->id)->where('status', 1)->where('covered', 1)->orderBy('id', 'desc')->Paginate(12, null, 1, $page);
	// 	$lastPage = $posts->lastPage();
	// 	$currentPage = $posts->currentPage();
	// 	$footer =footer::all();;		
	// 	return  view('app_rwd.index.default_cat', [
	// 		'footer'=>$footer,
	// 		'category'=>$category,
	// 		'posts'=>$posts,
	// 		'lastPage' => $lastPage,
	// 		'currentPage' => $currentPage,
	// 		'cate' => $cats->name_en
	// 	]);	
	// }
	// //熱門
	// public function hot($page = 1) {
	// 	$article = $this->show_api(1);
	 
		
	// 	// //add pv;
	// 	// PostsDetail::find($id)->increment('count_view');
		   	 		
	// 	// //suggest post
	// 	// $tags = PostsTagRelationships::where('post_id', $id)->get();
	// 	// //var_dump($tags);
	// 	// $tagarr = [];
	// 	// foreach ($tags as $tag) {
	// 	// 	$tagarr[] = $tag['post_tag_id'];

	// 	// }
		
	// 	//$relate = \DB::table('posts_tag_relationships')->whereIn('post_tag_id', $tagarr)->groupBy('post_id')->inRandomOrder()->limit(6)->get();
	// 	// $relate = PostsTagRelationships::with('article')->where('post_id','!=', $id)->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(14)->get();	 		
		
	// 	$posts = PostsDetail::with('hot')->orderBy('count_view', 'desc')->Paginate(10, null, 1, $page);
	// 	$adDetail = AdDetailBanner::inRandomOrder()->where('type', 'video')->where('status',1)->limit(2)->get();
	// 	$lastPage = $posts->lastPage();
	// 	$currentPage = $posts->currentPage();
	// 	$footer =footer::all();
	// 	$marquee =Announcement::inRandomOrder()->where('status',2)->first();
	
	// 	$marqueeArr = [];
	// 	if($marquee){
	// 		$marqueeArr = explode(':', $marquee->text);
	// 	}
	
	// 	$adlog = [];
	// 	$now = date('Y-m-d H:i:s');
	// 	if(count($posts) >0){
	// 		foreach ($adDetail as $ad) {
	// 			$log =  ['ad_id' => $ad->id ,'actiontype' =>0,'updated_at'=>$now] ;
	// 			$adlog[]  = $log;;
	// 			$ad->isAd  = true;
	// 			$this->array_insert($posts,rand(0,count($posts)-1),$ad);
	// 		}
	// 	}

	// 	if(count($adlog) >0){
	// 		DB::table('ad_detail_banner_log')->insert($adlog);
	// 	}
		 
	// 	if($posts) {
	// 		$device = Utils::chkdevice();
	// 		return view('app_rwd.index.default_hot',[
	// 			'post'=> $article,
	// 			'footer'=>$footer,
	// 			'lastPage' => $lastPage,
	// 			'currentPage' => $currentPage,
	// 			'device' => $device,
	// 			'posts'=> $posts,
	// 			'title'=> '热门影片',
	// 			'tag' => 'hot',
	// 			'marquee' => $marqueeArr,
	// 		]);
	// 	} else {
	// 		//沒有文章跳轉
	// 		echo '沒有文章';
	// 		header("Location:/"); 
	// 	}
	// }
	//標籤
	public function tag($tag, $page = 1) {
		$article = $this->show_api(1);

		//echo($tag);
		//$category = PostsTag::all();
		$tags = PostsTag::where('id', $tag)->first();		
		if($tags == null) {
			header("Location:/");
			return ;
		}		
		
		$posts = PostsTagRelationships::with('article')->with('hot')->where('post_tag_id', $tag)->where('status', 1)->orderBy('post_id', 'desc')->Paginate(10, null, 1, $page);
		$footer =footer::all();
		//$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->with('commentsGod')->where('cate_id', $cats->id)->where('status', 1)->orderBy('id', 'desc')->Paginate(10, null, 1, $page);
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();

		$adDetail = AdDetailBanner::inRandomOrder()->where('type', 'video')->where('status',1)->limit(2)->get();
		$marquee =Announcement::inRandomOrder()->where('status',2)->first();
	
		$marqueeArr = [];
		if($marquee){
			$marqueeArr = explode(':', $marquee->text);
		}
	 
		$now = date('Y-m-d H:i:s');
		$adlog = [];
		if(count($posts) >0){
			foreach ($adDetail as $ad) {
				$log =  ['ad_id' => $ad->id ,'actiontype' =>0,'updated_at'=>$now] ;
				$adlog[]  = $log;;
				$ad->isAd  = true;
				$this->array_insert($posts,rand(0,count($posts)-1),$ad);
			}
		}

		if(count($adlog) >0){
			DB::table('ad_detail_banner_log')->insert($adlog);
		}
 
	    // $tagarr = [1,2,4,10,11];
		// $relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(10)->get();	 		
		//var_dump($posts);
		
		$device = Utils::chkdevice();
		return  view('app_rwd.index.default_tag', [
			'post'=> $article,
			'footer'=>$footer,
			'posts'=>$posts,
			'lastPage' => $lastPage,
			'currentPage' => $currentPage,
			'device' => $device,
			// 'relate' => $relate,
			'tag' => $tags->id,
			'title' => $tags->name,
			'marquee' => $marqueeArr,
		]);	
		
	}	
	public function destroy($id)
    {
        //
    }
    public function searchVideo($search ='',$page = 1, $lang = 'jp'){
		$article = $this->show_api(1);

		$webLangIndex = $this->language[$lang];
		$whereArr = [];	
		DB::enableQueryLog();
		$Video_actress_name = Video_actress_name::where('sub_name', 'like', '%'.strtoupper($search).'%')->pluck('name')->all();//找女優 對應表
	
		$video = Video::whereRaw("UPPER(title) LIKE '%". strtoupper($search)."%'");
		if(count($Video_actress_name) > 0) {
			$video->orwhere(function ($query) use($Video_actress_name) {
				for ($i = 0; $i < count($Video_actress_name); $i++){
				   $query->orwhere('actress', 'like',  '%' . $Video_actress_name[$i] .'%');
				}      
		   });
		}
		$video = $video->where(['video_lang'=>$webLangIndex])->get();


		var_dump( DB::getQueryLog());
		DB::enableQueryLog();
		$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->with('commentsGod')
		->where('cate_id', 3)->where('status', 1)->where('covered', 1)
		->whereRaw("UPPER(title) LIKE '%". strtoupper($search)."%'")
		// ->where('title','like', '%'.$search.'%')
		->orderBy('id', 'desc')
		->Paginate(12, null, 1, $page);
		$footer =footer::all();;
		//$adDetail = AdDetailBanner::inRandomOrder()->where('type', 'video')->where('status',1)->limit(2)->get();
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();
		 
		$marquee =Announcement::inRandomOrder()->where('status',2)->first();
		var_dump($video);
		$marqueeArr = [];
		if($marquee){
			$marqueeArr = explode(':', $marquee->text);
		}
		// $now = date('Y-m-d H:i:s');
		// if(count($posts) >0){
		// 	foreach ($adDetail as $ad) {
		// 		$log =  ['ad_id' => $ad->id ,'actiontype' =>0,'updated_at'=>$now] ;
		// 		$adlog[]  = $log;;
		// 		$ad->isAd  = true;
		// 		$this->array_insert($posts,rand(0,count($posts)-1),$ad);
		// 	}
		// }

		// if(count($adlog) >0){
		// 	DB::table('ad_detail_banner_log')->insert($adlog);
		// }
	 
		if($posts) {
			//return $posts;
			$device = Utils::chkdevice();
			return view('app_rwd.index.default_search',[
				'posts'=> $posts,
				'footer'=>$footer,
				'post'=> $article,
				'search'=>$search,
				'lastPage' => $lastPage,
				'currentPage' => $currentPage,
				'device' => $device,		 
				'title'=> '搜尋',
				'tag' => 'search',
				'marquee' => $marqueeArr,
				'videos'=> $video,
			]);
		} else {
			//沒有文章跳轉
			echo '沒有文章';
			header("Location:/"); 
		}

 
 
    }
	public function postpage() {
		/*
	    $u = new User();
	    $user = $u->checkLogin();
		*/
	
		 
		if (Auth::check()) {
			// 這個使用者已經登入...
			if (Auth::User()->user_type != 1){
				//不為管理者
				return redirect('/');
			}
		} else {
			return redirect('/');
		}
		
		$tags = PostsTag::where('status', 1)->orderby('term_order', 'desc')->get();
		$waterMark = config('app.watermarkText');
		/*
		if($user == false) {
			header("Location:/") ;
			return ;		       
	    }
	    */
		$device = Utils::chkdevice();
		return view('app_rwd.index.postpagev2',[
			'waterMark' =>  $waterMark,
			'tags' => $tags,
			'device' => $device,
			'postArticle' => true
		]);
	}
	public function updateUser(Request $request){
		if (Auth::check()) {
			// 這個使用者已經登入...
			$user  = Auth::User();
			if ($user) {
				$column = '';
				$value ='';
				if($request->nick_name) {
					$column ='nick_name';
					$value = $request->nick_name;

				
				} else if($request->aaccount) {
					$column ='aaccount';
					$value = $request->aaccount;
					
				 
				} else if ($request->wechat ) {
					$column ='wechat';
					$value = $request->wechat;
				}
				 

			 
				Users::where('login_account','test002@gmail.com')->update( [ $column => $value ] );
				return response()->json(['nick_name' =>$request->nick_name,'aaccount' => $request->aaccount,'wechat' => $request->wechat,'match',$match ]);
				 
				
			}
		} else {
			return response()->json(['count_digg' => 1, 'status' => 1,'login' => false]);
		}

	}
	public function userInfo(Request $request){
		if (Auth::check()) {
			// 這個使用者已經登入...
			$user  = Auth::User();
			if ($user) {
				$id = intval($request->id);
 
				$postsDigg =PostsDigg::where('user_id',$user->user_id)->orderBy('post_id', 'desc')->pluck('post_id');
				$footer =footer::all();	 
				$category = PostsCategory::all();


				$posts  = [];
				if($postsDigg) {
					$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->where('cate_id', 3)->where('status', 1)->whereIn('id', $postsDigg)->where('covered', 1)->orderBy('id', 'desc')->get();
				}

				 
				$device = Utils::chkdevice();
				return view('app_rwd.index.user_info',[
						// 'post'=> $article,
						'footer'=>$footer,
						// 'lastPage' => $lastPage,
						// 'currentPage' => $currentPage,
						'device' => $device,
						 'posts'=> $posts,   
						'title'=> '用戶资讯',
						 'user'=>$user,
						// 'marquee' => $marqueeArr,
					]);
				 
				 
				
				$status = 0;
				if($postsDigg) {
					$status = $postsDigg['status'];
				   if ($status == 1){ //有讚
						PostsDetail::find($id)->decrement('count_digg');
				   } else if ($status == 2){ //有倒讚
						$postsDetail = PostsDetail::find($id);
						$postsDetail->increment('count_digg');
						$postsDetail->decrement('count_bury');
					 
				   } else {
						PostsDetail::find($id)->increment('count_digg');
				   }
				} else {
					PostsDetail::find($id)->increment('count_digg');

					$Digg = new PostsDigg;
					$Digg->user_id = $user->user_id;
					$Digg->post_id = $id;
					$Digg->status = 1;
					$Digg->save();
				}

				if($status != 1) {
					$status = 1;
					PostsDigg::where('user_id',$user->user_id)->where('post_id',$id)->update( [ 'status' => 1 ] );
				} else {
					$status = 0;
					PostsDigg::where('user_id',$user->user_id)->where('post_id',$id)->update( [ 'status' => 0 ] );
				}

				$postsDetail = PostsDetail::find($id);
				return response()->json(['count_digg' => $postsDetail['count_digg'],'count_bury' => $postsDetail['count_bury'], 'status' => $status,'login' => true]);
			}
		} else {
			header("Location:/");
			return; 
		}

	}

	public function postpageNew() {
	    $u = new User();
	    $user = $u->checkLogin();
		
		$tags = PostsTag::where('status', 1)->orderby('term_order', 'desc')->get();
		
		if($user == false) {
			header("Location:/member/login?forward=/article/post") ;
			return ;		       
	    }
				
		return view('app_rwd.index.postpagev5',[
			'tags' => $tags
		]);
	}
 
	public function thumbsup(Request $request){
		if (Auth::check()) {
			// 這個使用者已經登入...
			$user  = Auth::User();
			if ($user) {
				$id = intval($request->id);
 
				$postsDigg =PostsDigg::where('user_id',$user->user_id)->where('post_id',$id)->first();
				$status = 0;
				if($postsDigg) {
					$status = $postsDigg['status'];
				   if ($status == 1){ //有讚
						PostsDetail::find($id)->decrement('count_digg');
				   } else if ($status == 2){ //有倒讚
						$postsDetail = PostsDetail::find($id);
						$postsDetail->increment('count_digg');
						$postsDetail->decrement('count_bury');
					 
				   } else {
						PostsDetail::find($id)->increment('count_digg');
				   }
				} else {
					PostsDetail::find($id)->increment('count_digg');

					$Digg = new PostsDigg;
					$Digg->user_id = $user->user_id;
					$Digg->post_id = $id;
					$Digg->status = 1;
					$Digg->save();
				}

				if($status != 1) {
					$status = 1;
					PostsDigg::where('user_id',$user->user_id)->where('post_id',$id)->update( [ 'status' => 1 ] );
				} else {
					$status = 0;
					PostsDigg::where('user_id',$user->user_id)->where('post_id',$id)->update( [ 'status' => 0 ] );
				}

				$postsDetail = PostsDetail::find($id);
				return response()->json(['count_digg' => $postsDetail['count_digg'],'count_bury' => $postsDetail['count_bury'], 'status' => $status,'login' => true]);
			}
		} else {
			return response()->json(['count_digg' => 1, 'status' => 1,'login' => false]);
		}

	}
	public function array_insert(&$arr,$index,$value)
	{
		$lengh = count($arr);
		if($index<0||$index>$lengh)
			return;
	
		for($i=$lengh; $i>$index; $i--){
			$arr[$i] = $arr[$i-1];
		}
	
		$arr[$index] = $value;
	 
	}
	public function thumbsdown(Request $request){
		if (Auth::check()) {
			// 這個使用者已經登入...
			$user  = Auth::User();
			if ($user) {
				$id = intval($request->id);
 
				$postsDigg =PostsDigg::where('user_id',$user->user_id)->where('post_id',$id)->first();
				$status = 0;
				if($postsDigg) {
					$status = $postsDigg['status'];
					
				   if ($status == 1){ //有讚
						$postsDetail = PostsDetail::find($id);
						$postsDetail->increment('count_bury');
						$postsDetail->decrement('count_digg');
				   } else if ($status == 2){ //有倒讚
						PostsDetail::find($id)->decrement('count_bury');
				   } else {
						PostsDetail::find($id)->increment('count_bury');
				   }
				} else {
					PostsDetail::find($id)->increment('count_bury');
					$Digg = new PostsDigg;
					$Digg->user_id = $user->user_id;
					$Digg->post_id = $id;
					$Digg->status = 2;
					$Digg->save();
				}

				if($status != 2) {
					$status = 2;
					PostsDigg::where('user_id',$user->user_id)->where('post_id',$id)->update( [ 'status' => 2 ] );
				} else {
					$status = 0;
					PostsDigg::where('user_id',$user->user_id)->where('post_id',$id)->update( [ 'status' => 0 ] );
				}

				$postsDetail = PostsDetail::find($id);
				return response()->json(['count_digg' => $postsDetail['count_digg'],'count_bury' => $postsDetail['count_bury'], 'status' => $status,'login' => true]);
			}
		} else {
			return response()->json(['count_digg' => 1, 'status' => 1,'login' => false]);
		}	 
	}
	public function videoinfo(Request $request){

		$all = PostsArticle::where('status', 1)->where('covered', 1)->orderBy('id', 'desc')->count();
		$today = PostsArticle::whereDate('created_time', Carbon::now()->format('m/d/Y'))->where('covered', 1)->orderBy('id', 'desc')->count();
		$tags = PostsTag::where('status', 1)->orderby('term_order', 'desc')->get();
		// $today = 1;
	 
		$tagarr = [];
		foreach ($tags as $tag) {
			$tagarr[] = ['name'=>$tag['name'],'id'=>$tag['id']];
		}
		return response()->json(['all' => $all,'today' => $today,'tags'=>$tagarr]);
	}
	public function clickAd(Request $request, $id){
		// $ad = $this->get_ad($id);
		$ad = AdDetailBanner::where('id',$id)->where('status', 1)->first();
	
		if(!$ad) {
			header("Location:/");
			return ;
		}
		$now = date('Y-m-d H:i:s');
		$log =  ['ad_id' => $id ,'actiontype' =>1,'updated_at'=>$now] ;
		DB::table('ad_detail_banner_log')->insert($log);
	 
		return response()->json(['status' => 1,'address' => $ad->web_url]);
	}
	
}
