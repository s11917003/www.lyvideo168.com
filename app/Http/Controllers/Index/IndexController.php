<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\PostsArticle;
use App\Model\PostsCategory;
use App\Model\PostsDetail;
use App\Model\PostsTag;
use App\Model\PostsTagRelationships;

use App\Lib\User;
use App\Lib\Utils;

class IndexController extends Controller {	
	
	public function index($page = 1) {

       	$value = @$_COOKIE['appdl'];
	   	if($value == true) {
		   	header('Location:/event/app/en');
		   	return ;
	   	}


       	$value = @$_COOKIE['agevarify'];
	   	if($value != true) {
		   	header('Location:/warning');
		   	return ;
	   	}   	
	   	
				
		$category = PostsCategory::all();
		$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->with('commentsGod')->where('cate_id', 3)->where('status', 1)->where('covered', 1)->orderBy('id', 'desc')->Paginate(6, null, 1, $page);
		
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();
	    
	    $tagarr = [1,2,4,10,11];
		$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(10)->get();	 		

	 
		//return  view('app.index.default', [
		$device = Utils::chkdevice();
		
		return  view('app_rwd.index.default', [
			'category'=>$category,
			'posts'=>$posts,
			'lastPage' => $lastPage,
			'currentPage' => $currentPage,
			'device' => $device,
			'relate' => $relate,
			'loadmore' => true,
			'path' =>  env('APP_URL').'app/public',		
		]);
	}
	
	public function loadmore($page = 2) {
		$category = PostsCategory::all();
		$posts = PostsArticle::with('detail')->with('userInfo')->where('status', 1)->where('covered', 1)->orderBy('id', 'desc')->Paginate(10, null, 1, $page);
		$lastPage = $posts->lastPage();
		
		return response()->json([
			'posts' => $posts
		]);
	}
	
	public function postview(Request $request, $id) {
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
		$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(14)->get();	 		
		if($article) {
			$device = Utils::chkdevice();
			return view('app_rwd.index.pview',[
				'post'=>$article,
				'device' => $device,
				'relate' => $relate
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
		$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(14)->get();	 		
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
	
	//分類
	public function category($cat, $page = 1) {
		
		$category = PostsCategory::all();
		$cats = PostsCategory::where('name_en', $cat)->first();
		if($cats == null) {
			header("Location:/");
			return ;
		}		
		
		$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->with('commentsGod')->where('cate_id', $cats->id)->where('status', 1)->where('covered', 1)->orderBy('id', 'desc')->Paginate(10, null, 1, $page);
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();
				
		return  view('app_rwd.index.default_cat', [
			'category'=>$category,
			'posts'=>$posts,
			'lastPage' => $lastPage,
			'currentPage' => $currentPage,
			'cate' => $cats->name_en
		]);	
		
	}
	
	//標籤
	public function tag($tag, $page = 1) {
		
		//echo($tag);
		//$category = PostsTag::all();
		$tags = PostsTag::where('id', $tag)->first();		
		if($tags == null) {
			header("Location:/");
			return ;
		}		
		
		$posts = PostsTagRelationships::with('article')->where('post_tag_id', $tag)->where('status', 1)->orderBy('post_id', 'desc')->Paginate(10, null, 1, $page);
		
		//$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->with('commentsGod')->where('cate_id', $cats->id)->where('status', 1)->orderBy('id', 'desc')->Paginate(10, null, 1, $page);
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();

	    $tagarr = [1,2,4,10,11];
		$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(10)->get();	 		
		//var_dump($posts);
		
		$device = Utils::chkdevice();
		return  view('app_rwd.index.default_tag', [
			'posts'=>$posts,
			'lastPage' => $lastPage,
			'currentPage' => $currentPage,
			'device' => $device,
			'relate' => $relate,
			'tag' => $tags->name
		]);	
		
	}	
	
	public function postpage() {
		/*
	    $u = new User();
	    $user = $u->checkLogin();
	    */
		
		$tags = PostsTag::where('status', 1)->orderby('term_order', 'desc')->get();
		
		/*
		if($user == false) {
			header("Location:/") ;
			return ;		       
	    }
	    */
		$device = Utils::chkdevice();
		return view('app_rwd.index.postpagev2',[
			'tags' => $tags,
			'device' => $device
		]);
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
	
}
