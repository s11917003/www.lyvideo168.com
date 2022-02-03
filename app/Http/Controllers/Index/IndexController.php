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
use App\Model\Video_actress;
use App\Model\Video_actress_relations;
use App\Model\Video_tag_relations;
use App\Model\Video_tag;
use App\Model\Video_rank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
//  use App\Lib\User;
use App\Lib\Utils;
use Cookie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
 
use Illuminate\Support\Facades\App;
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
	public function home_index() {
		return redirect()->to('/'.app()->getLocale().'/home')->send();
	}
	public function index($lang) {
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		$webLangIndex = $this->language[$lang];
		$video1 = Video::where(['cate_id'=>1,'video_lang'=>$webLangIndex])->orderBy('id', 'desc')->limit(16)->get();	
		$video2 = Video::where(['cate_id'=>2,'video_lang'=>$webLangIndex])->orderBy('id', 'desc')->limit(16)->get();		
		$video3 = Video::where(['cate_id'=>3,'video_lang'=>$webLangIndex])->orderBy('id', 'desc')->limit(16)->get();	
		$video4 = Video::where(['cate_id'=>4,'video_lang'=>$webLangIndex])->orderBy('id', 'desc')->limit(16)->get();	


	 
		return view('app_rwd.index.index',[
			'video1' => $video1,
			'video2' => $video2,
			'video3' => $video3,
			'video4' => $video4,
			'lang'=>$lang
		]);
	}
	public function popular($lang) {
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		$webLangIndex = $this->language[$lang];

		$video_actress_popular = Video_actress::whereIn('id',[2,3,4,5,6,11,12,13,26,28,30])->get();// 女優table;
		$tag_actress_popular = Video_tag::whereIn('id',[2,14,22,24,93,38,8,28,17,51,53,87])->get();

		$series = [];
		if($lang == 'zh') {
			$series = ['顔面崩壊調教','逆痴漢','風俗中出しSEX','縄犯'];
		}else if($lang == 'en') {
			$series = ['VR BEST','Venus Therme','Uhar Bitch','Shameful Girl'];
		} else {
			$series = ['顔面崩壊調教','誘惑美容室','美熟女ベスト','羞恥！'];
		}
		return  response()->json(['video_series_popular' => $series, 'video_actress_popular' => $video_actress_popular,'tag_actress_popular' => $tag_actress_popular]);
		
	}
	public function curl_get_contents($url)
	{
		$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	$html = curl_exec($ch);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
	}
	public function postview1(Request $request, $lang, $id) {
	
		$video_id = explode("$",$id)[0];
		
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
 
		//主影片DATA
		$webLangIndex = $this->language[$lang];
 
		// DB::enableQueryLog
		$video = Video::where(['video_id'=>$video_id,'video_lang'=>$webLangIndex])->first();
	
	
		if(!$video) {
			return redirect()->to('/')->send();
		} 
 
 		$video_tag =  Video_tag_relations::where('video_id',$video->id)->with('tagName')->get();
	
		$video_with_actress = [];
	
		if($video['actress']){ 
 
			$Video_actress = Video_actress_relations::select('*')->with('tagRelations')->where('video_id', $video->id)->get();//找女優 對應表
			
			$actress = [];
			$actressName = [];
			$actressData= []; 
		
			foreach($Video_actress as $data){
				$actress[] = $data->actress_id;
				$actressName[]  = $data->tagRelations->JapaneseName1;
				$actressData[] = ['id' => $data->actress_id , 'name' =>  $data->tagRelations->JapaneseName1];
			}
		
			$Video_actress_relations = Video_actress_relations::select('*')->whereIn('actress_id', $actress)->limit(50)->pluck('video_id')->toArray();;//找女優相關
			$video_with_actress = Video::whereIn('id', $Video_actress_relations)->where('video_lang',$webLangIndex)->limit(20)->get();
			if(count($actressName)>0){
				$video['actress'] =  implode("&", $actressName); 
			}

			$video['actressData'] = $actressData;
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

			
				$img_path[] =$path.'/'.$filename;
				if($isExists){
					continue;
				} else {
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
					$html = curl_exec($ch);
					$data = curl_exec($ch);
					curl_close($ch);
					 
					//$contents = file_get_contents($url);
					\Storage::disk('public')->put($path.$filename,$data);
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
		DB::enableQueryLog();
		////相關標籤影片
	 	$randTag = Video_tag_relations::where('video_id',$video->id)->inRandomOrder()->first();
		
		$video_relation = [];
		if($randTag){
			$same_tag_video = Video_tag_relations::where('tag_id',$randTag->tag_id)->inRandomOrder()->limit(50)->pluck('video_id')->toArray();
		
			//$video_relation = Video::where('video_lang',$webLangIndex)->with(['tagRelations'])->whereHas('tagRelations', function($q) use ($randTag) { $q->where('tag_id', '=', $randTag->tag_id); })->limit(10)->get();
			$video_relation = Video::where('video_lang',$webLangIndex)->whereIn('id', $same_tag_video)->with(['tagRelations'])->limit(10)->get();
			
	 
		}
	 
		
		$title  = $video['video_id'].'|'.$video['actress'].'無料エロ動画【JavDic  '. implode(",", $tagName).'】';
		$video_status = false;
		$url = $video['video_url'];
		$array = @get_headers($url);
		if(!empty($array)){
			$string = $array[0];
			// 404 for error, 200 for no error
			if(strpos($string, "200")) {
				$video_status = true;
			} 
		 }
		

		$url ='';
		//生成頁面連結
		if($video['cate_id'] == 1){ //fanzy r18
			$url =  'https://media.r18.com/track/MjM3Mi4xLjEuMS4wLjAuMC4wLjA/videos/vod/movies/detail/-/id='.$video['video_id'] .'/';
		} else if ($video['cate_id'] == 2){
			$url =  'https://www.mgstage.com/product/product_detail/'.$video['video_id'].'/?aff=JAQD55TL3ANYC8C2Y3CZZHBAZY';
		} else if ($video['cate_id'] == 3){
			$url =  'https://click.dtiserv2.com/Direct/900'.str_pad(intval($video['uncensored_code']),3,"0",STR_PAD_LEFT).'999-'.$video['uncensored_code'].'-198346/moviepages/'.$video['video_id'].'/index.html';
		} else if ($video['cate_id'] == 4){
			$url =  'https://adult.contents.fc2.com/aff.php?aid='.$video['video_id'].'&affuid=TXpjMU5qTTFPREU9';
		}
		if($video) {
			$device = Utils::chkdevice();
			return view('app_rwd.index.pview',[
				'url' => $url,
				'footer'=>$footer,
				'device' => $device,
				'video' => $video, 							//主影片
				'video_status' => $video_status, 			//影片狀態
				'video_with_actress' => $video_with_actress,//相關女優
				'video_tag' => $video_tag,					//標籤
				'title' =>  $title,						//影片title
				'video_relation' => $video_relation, 		//相關標籤
				'lang' => $lang
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
				'title' =>  $title,  						//影片title
				'lang' => $lang
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
	public function category(string $lang) {
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		
		// $tag->main_tag =  1;  //主要的分類tag
		// $secondary_tagTemp = \Session::get('secondary_tag');//已自訂的tag
		// $secondary_tag = [];
		// if($secondary_tagTemp){
		// 	$secondary_tag  = explode(",", $secondary_tagTemp); //已自訂的tag
		// } 
		$combo_tag = Video_tag::where('main_tag','!=',1)->get();
		$webLangIndex = $this->language[$lang];

		 
		return view('app_rwd.index.category',[ 'category'=>-1,'lang' => $lang,'combo_tag' =>json_decode($combo_tag)]);
	}
	public function category_genre(string $lang,string $genre) {
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		if( !in_array($genre,['censored','uncensored','amateur'])){
			abort(404);
		}
		
		$combo_tag = Video_tag::where('main_tag','!=',1)->get();
		$webLangIndex = $this->language[$lang];

		return view('app_rwd.index.category',[ 'category'=>array_search($genre,['censored','uncensored','amateur']),'lang' => $lang,'combo_tag' =>json_decode($combo_tag)]);
 
	}
	public function categoryCancel(Request $request,string $lang) {

	 
		if(!isset( $request->customTag)){
			return;
		}
		if( !in_array($lang,['zh','en','jp'])){
			return;
		}
		$webLangIndex = $this->language[$lang];
		$sourece_array = [];
		$secondary_tagTemp = \Session::get('secondary_tag');
		$secondary_tag = [];
		if($secondary_tagTemp){
			$secondary_tag  = explode(",", $secondary_tagTemp);
		} 
		$Video_tag = Video_tag::where('id',$request->customTag)->first();
		
		if($Video_tag->main_tag !=1 ){ //自訂
			$key = array_search((string)$Video_tag->id,$secondary_tag);
			if ($key !== false) {
				unset($secondary_tag[$key]);
			}
		}
		$Video_tag_screen = Video_tag::whereIn('id', $secondary_tag)->get();
		foreach ($Video_tag_screen as $tag) {
			$tag['check'] = true;
			if(!in_array((string)$tag->id,$request->tag)){  
				$tag['check'] = false;
			
				} 
		} 
		\Session::put('secondary_tag', '');
		\Session::put('secondary_tag', implode(",",$secondary_tag));
		if(is_null( $request->tag)){
			return  response()->json([ 'secondary_tag' => $Video_tag_screen ,'video' =>[]]);
		}
		if(in_array("all", $request->tag)){
			$video = Video::select('*')->where('video_lang',$webLangIndex)->Paginate(36);
			return  response()->json([ 'secondary_tag' => $Video_tag_screen ,'video' =>$video ]);
		} else {
			if( in_array('censored_f',$request->tag)){
				$sourece_array[] =1;
			}
			if( in_array('censored_p',$request->tag)){
				$sourece_array[] =2;
			}
			if( in_array('uncensored',$request->tag)){
				$sourece_array[] =3;
			}
			if( in_array('FC2',$request->tag)){
				$sourece_array[] = 4;
			}
		}
  	    $combo_tag = Video_tag::where('main_tag','!=',1)->whereNotIn('id',$secondary_tag)->get();	
		$tag = $request->tag;
		 $video = Video::select('*')->where('video_lang',$webLangIndex)->whereHas('tagRelations', function($q) use ($tag){
   						 $q->whereIn('tag_id',$tag);
		})->orWhere(function ($query) use ($sourece_array) {
			$query->whereIn('cate_id',$sourece_array);
		})->Paginate(36) ;
		return  response()->json([ 'secondary_tag' => $Video_tag_screen , 'video' =>$video,'combo_tag' =>$combo_tag,  'pagination' => (string)$video->links("pagination::bootstrap-4"), ]);
		
	}
	
	public function categoryAdd(Request $request,string $lang) {
		if(!isset( $request->tag)){
			return false;
		}
	 	 
		$secondary_tag = \Session::get('secondary_tag');
		if($secondary_tag){
			$secondary_tag  = explode(",", $secondary_tag);
		} else {
			$secondary_tag  = [];
		}
       
		$Video_tag = Video_tag::where('id',$request->tag)->first();
	
	    if ($Video_tag) {
			if($Video_tag->main_tag !=1 ){ //自訂
				 if(!in_array((string)$Video_tag->id,$secondary_tag)){ //未存進SESSIOM
					array_push($secondary_tag, $tag->id);
					\Session::put('secondary_tag', '');
			        \Session::put('secondary_tag', implode(",",$secondary_tag));
				}
			}
	  	} 
		$combo_tag = Video_tag::where('main_tag','!=',1)->whereNotIn('id',$secondary_tag)->get();	
		return  response()->json([   'Video_tag' =>$Video_tag,'combo_tag' =>$combo_tag]);
		
	}
	public function categoryPost(Request $request,string $lang) {
		if(!isset( $request->tag)){
			return false;
		}
		if( !in_array($lang,['zh','en','jp'])){
			return;
		}
		$webLangIndex = $this->language[$lang];
		$sourece_array = [];
		
	
		if(in_array("all", $request->tag)){
			$video = Video::select('*')->where('video_lang',$webLangIndex)->Paginate(36) ;
			$secondary_tag = \Session::get('secondary_tag');
			$Video_tag_screen = Video_tag::whereIn('id',  explode(",", $secondary_tag))->get();
			foreach ($Video_tag_screen as $tag) {
				$tag['check'] = true;
				if(!in_array((string)$tag->id,$request->tag)){  
					$tag['check'] = false;
				 } 
			} 
			$combo_tag = Video_tag::where('main_tag','!=',1)->get();	
			return  response()->json([ 'secondary_tag' => $Video_tag_screen ,'video' =>$video,'combo_tag' =>$combo_tag,  'pagination' => (string)$video->links("pagination::bootstrap-4"), ]);
		} else {
			if( in_array('censored_f',$request->tag)){
				$sourece_array[] =1;
			}
			if( in_array('censored_p',$request->tag)){
				$sourece_array[] =2;
			}
			if( in_array('uncensored',$request->tag)){
				$sourece_array[] =3;
			}
			if( in_array('FC2',$request->tag)){
				$sourece_array[] = 4;
			}
		}
		$tag = $request->tag;
	    $videoIntag =  Video_tag_relations::where('tag_id',$tag)->with('tagName')->limit(7000)->pluck('video_id')->toArray();

		$video = Video::select('*')->where('video_lang',$webLangIndex)->whereIn('id',$videoIntag)->orWhere(function ($query) use ($sourece_array) {
		$query->whereIn('cate_id',$sourece_array);
		})->Paginate(36) ;
	 
		return  response()->json([ 'video' =>$video,  'pagination' => (string)$video->links("pagination::bootstrap-4"), ]);
		
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

	public function search( $lang,$search =''){
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		if($search ==''){
			abort(404);
		}
		$webLangIndex = $this->language[$lang];
		return view('app_rwd.index.search',['search'=>$search,'lang'=>$lang]);
	}
	public function searchDirector($lang){
		$search = request()->query('search');
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		if($search ==''){
			abort(404);
		}
		$webLangIndex = $this->language[$lang];
		$videos = Video::where('video_lang',$webLangIndex)->where('director', $search)->get();//video table;
		return view('app_rwd.index.search_director',['videos' => $videos,'search'=>$search,'lang'=>$lang]);
	}
	public function searchStudio( $lang){
		
		$search = request()->query('search');
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		if($search ==''){
			abort(404);
		}

		$webLangIndex = $this->language[$lang];
		$videos = Video::where('video_lang',$webLangIndex)->where('studio', $search)->get();//video table;
		var_dump( DB::getQueryLog());
		 
		return view('app_rwd.index.search_director',['videos' => $videos,'search'=>$search,'lang'=>$lang]);
	}
	public function searchLabel( $lang){
		$search = request()->query('search');
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		if($search ==''){
			abort(404);
		}

		$webLangIndex = $this->language[$lang];
	 
		$videos = Video::where('video_lang',$webLangIndex)->where('label', $search)->get();//video table;
	 
		return view('app_rwd.index.search_director',['videos' => $videos,'search'=>$search,'lang'=>$lang]);
	}

	public function searchSeries( $lang){	
		$search = request()->query('search');
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		if($search ==''){
			abort(404);
		}

		$webLangIndex = $this->language[$lang];
		$videos = Video::where('video_lang',$webLangIndex)->where('series', $search)->get();//video table; 
		return view('app_rwd.index.search_director',['videos' => $videos,'search'=>$search,'lang'=>$lang]);
	}
	

    public function searchVideo(Request $request, $lang){  //修改
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		$search = $request->search;
		$webLangIndex = $this->language[$lang];
		// DB::enableQueryLog();
		$Video_actress_id = Video_actress::where('JapaneseName1', 'like', '%'.strtoupper($search).'%')
		->orWhere('ChineseName1', 'like', '%'.strtoupper($search).'%')
		->orWhere('ChineseName2', 'like', '%'.strtoupper($search).'%')
		->orWhere('ChineseName3', 'like', '%'.strtoupper($search).'%')
		->orWhere('JapaneseName2', 'like', '%'.strtoupper($search).'%')
		->orWhere('JapaneseName3', 'like', '%'.strtoupper($search).'%')
		->orWhere('JapaneseName4', 'like', '%'.strtoupper($search).'%')
		->orWhere('JapaneseName5', 'like', '%'.strtoupper($search).'%')
		->orWhere('JapaneseName6', 'like', '%'.strtoupper($search).'%')
		->orWhere('JapaneseName7', 'like', '%'.strtoupper($search).'%')
		->orWhere('JapaneseName8', 'like', '%'.strtoupper($search).'%')
		->pluck('id')->toArray();//找女優 對應表

	
		// var_dump( DB::getQueryLog());
		$videoIDs =Video_actress_relations::whereIn('actress_id',$Video_actress_id)->limit(5000)->pluck('id')->toArray();// 女優table;
		
		$videos = Video::where('video_lang',$webLangIndex)->where(function($query) use ($videoIDs,$search) {
			$query->whereIn('id', $videoIDs)
				  ->orWhere('title', 'like', '%'.strtoupper($search).'%');
		})->Paginate(48);//  video table;
		 
	 	return  response()->json(['video' =>$videos,  'pagination' => (string)$videos->links("pagination::bootstrap-4"), ]);
    }
	public function actress($lang) {
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		$webLangIndex = $this->language[$lang];
	
		return view('app_rwd.index.actress_list',['lang'=>$lang]);
    }
	public function actressList(Request $request) {
		$video_actress = Video_actress::withCount(['actressRelations','wiki'])->Paginate(24);// 女優table;
		return  response()->json(['video_actress' =>$video_actress,  'pagination' => (string)$video_actress->links("pagination::bootstrap-4") ]);
    }
	public function actressPage($lang,Int $id) {
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}	
		$webLangIndex = $this->language[$lang];
		$actress = Video_actress::where('id',$id)->with('wiki')->first();// 女優table;
		 
		if(!$actress || !$actress->wiki) {
			//abort(404);
			header("Location:/");
			return ;
		}
		 
		$videoIds  = Video_actress_relations::where('actress_id',$id)->pluck('video_id')->toArray();
		$videos_relation = Video::where('video_lang',$webLangIndex)->whereIn('id', $videoIds)->with('tagRelations')->get();//video table;
		$tagObj = [];
	  	//計算相關的標籤以及數量
	    $size = count($videos_relation); 
        for ($i=0; $i < $size; $i++) {
		    $data = $videos_relation[$i]['tagRelations'];
	    	foreach ($data  as $tag) {
    	    	if( !in_array($tag->tag_id,array_keys((array)$tagObj))){
    		        $tagObj[$tag->tag_id] = 1;
    		    } else {
    		       	$tagObj[$tag->tag_id] +=1;
    		    }
	    	}
		}
				 
	    $video_tag	= Video_tag::whereIn('id',array_keys((array)$tagObj))->get();
	  	foreach ($video_tag  as $tag) {
		    $tag['count'] = $tagObj[$tag->id];
		}
		return  view('app_rwd.index.actress',[
		    'video_tag' => $video_tag,
			'actress'=>$actress,
			'count'=>count($videoIds),
			'videos_relation' => $videos_relation,//相關女優
			'lang'=>$lang
		]);
    }
	public function rankPage(string $lang,Int $type) {
		if($type!='1' && $type!='2')
			abort(404);
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		$webLangIndex = $this->language[$lang];
		$fanza = Video_rank::where('video_source','fanza')->where('type',$type)->where('video_lang',$webLangIndex)->whereHas('video', function ($query)  use ($webLangIndex){
			$query->where('video_lang', '=', $webLangIndex );
	   })->orderBy('rank')->limit(8)->get();
		$prestige = Video_rank::where('video_source','mgstage')->where('type',$type)->where('video_lang',$webLangIndex)->with('video')->orderBy('rank')->limit(8)->get();
		$uncensored = Video_rank::where('video_source','uncensored')->where('type',$type)->where('video_lang',$webLangIndex)->with('video')->orderBy('rank')->limit(8)->get();
		$amateur = Video_rank::where('video_source','amateur')->where('type',$type)->where('video_lang',$webLangIndex)->with('video')->orderBy('rank')->limit(8)->get();
		 
		return view('app_rwd.index.rank',['type'=> $type ,
		'fanza'=>$fanza,
		'prestige'=>$prestige,
		'uncensored'=>$uncensored,
		'amateur'=>$amateur,
		'lang'=>$lang,
		'langIndex'=>$webLangIndex,
		]);
	}
	public function rankListPage(string $lang,string $cate) {
		if( !in_array($cate,['fanza','prestige','uncensored','amateur'])){
			abort(404);
		}
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		$webLangIndex = $this->language[$lang];
		//DB::enableQueryLog(); // Enable query log

  
		$post = Video_rank::where('video_source',$cate)->where('type',1)->where('video_lang',$webLangIndex)->with('video')->orderBy('rank')->get();

	 
		$post1 = Video_rank::where('video_source',$cate)->where('type',2)->where('video_lang',$webLangIndex)->whereHas('video', function ($query)  use ($webLangIndex){
			$query->where('video_lang', '=', $webLangIndex );
	   })->orderBy('rank')->get();
		
		return view('app_rwd.index.list',[
		'cate'=>$cate,
		'video'=>$post,
		'video1'=>$post1,
		'lang'=>$lang,
		'langIndex'=>$webLangIndex,
		]);
	}
	public function all(string $lang,string $cate) {
		if( !in_array($cate,['censored','uncensored','amateur'])){
			abort(404);
		}
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		return view('app_rwd.index.list',['cate'=>$cate,'lang'=>$lang]);
	}
	public function allList(Request $request,string $lang) { 
		if( !in_array($lang,['zh','en','jp'])){
			abort(404);
		}
		$webLangIndex = $this->language[$lang];
		$key = array_search($request->category,['censored','uncensored','amateur']);
		if ($key !== false) {
			if($key==0){
				$post = Video::whereIn('cate_id',[1,2])->where('video_lang',$webLangIndex)->orderBy('id', 'desc')->Paginate(36);
			} else {
				$post = Video::where(['cate_id'=>$key+1])->where('video_lang',$webLangIndex)->orderBy('id', 'desc')->Paginate(36);
			}
			return  response()->json(['status'=>true,'video' =>$post,  'pagination' => (string)$post->links("pagination::bootstrap-4") ]);
		}
		return  response()->json(['status'=>false]);
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

	public function lang(Request $request)
    {
        if($request->lang == 'en' || $request->lang == 'zh'|| $request->lang == 'jp'){
            Session::put('locale', $request->lang);
            App::setLocale($request->lang);
            return response()->json(['status' => true, 'lang' => $request->lang]);
        }
		return  response()->json(['status' => false]);
    }
	
}
