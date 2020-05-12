<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Pagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\PostsArticle;
use App\Model\PostsCategory;
use App\Model\PostsDetail;
use App\Model\PostsTag;
use App\Model\PostsDigg;
use App\Model\AdDetailBanner;
use App\Model\PostsTagRelationships;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Lib\User;
use App\Lib\Utils;

class IndexController extends Controller {	
	
	public function index($page = 1) {

       	// $value = @$_COOKIE['appdl'];
	   	// if($value == true) {
		//    	header('Location:/event/app/en');
		//    	return ;
	   	// }


       	// $value = @$_COOKIE['agevarify'];
	   	// if($value != true) {
		//    	header('Location:/warning');
		//    	return ;
	   	// }   	
	 
	 	$category = PostsCategory::all();
		$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->with('commentsGod')->where('cate_id', 3)->where('status', 1)->where('covered', 1)->orderBy('id', 'desc')->Paginate(18, null, 1, $page);
		
		
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();
	    
	    $tagarr = [1,2,4,10,11];
		$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(10)->get();	 		

		$adDetail = AdDetailBanner::inRandomOrder()->where('type', 'video')->where('status',1)->limit(2)->get();

		$adHalf = AdDetailBanner::inRandomOrder()->where('type', 'half')->where('status',1)->limit(1)->get();
		//return  view('app.index.default', [
		$device = Utils::chkdevice();
		
		return  view('app_rwd.index.default', [
			'ad'=>$adDetail,
			'adHalf'=>$adHalf,
			'category'=>$category,
			'posts'=>$posts,
			'lastPage' =>  $lastPage,
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
		$postsDetail = PostsDetail::find($id);
	 
		//suggest post
		$tags = PostsTagRelationships::where('post_id', $id)->get();
		//var_dump($tags);
		$tagarr = [];
		foreach ($tags as $tag) {
			$tagarr[] = $tag['post_tag_id'];

		}
		
		//$relate = \DB::table('posts_tag_relationships')->whereIn('post_tag_id', $tagarr)->groupBy('post_id')->inRandomOrder()->limit(6)->get();
		$relate = PostsTagRelationships::with('article')->where('post_id','!=', $id)->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(14)->get();	 		
		
		$adDetail = AdDetailBanner::inRandomOrder()->where('type', 'video')->where('status',1)->limit(2)->get();
		$status = 0;
		if (Auth::check()) {
			$user  = Auth::User();
			if ($user) {
				$postsDigg = PostsDigg::where('user_id',$user->user_id)->where('post_id',$id)->first();
				$status = $postsDigg['status'];
			}
		}
		
		if($article) {
			$device = Utils::chkdevice();
			return view('app_rwd.index.pview',[
				'ad'=>$adDetail,
				'post'=>$article,
				'device' => $device,
				'relate' => $relate,
				'postsDetail' => $postsDetail,
				'status' => $status,
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
	
	//分類
	public function category($cat, $page = 1) {
		
		$category = PostsCategory::all();
		$cats = PostsCategory::where('name_en', $cat)->first();
		if($cats == null) {
			header("Location:/");
			return ;
		}		
		
		$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->with('commentsGod')->where('cate_id', $cats->id)->where('status', 1)->where('covered', 1)->orderBy('id', 'desc')->Paginate(12, null, 1, $page);
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
	//熱門
	public function hot($page = 1) {
		$article = $this->show_api(1);
	 
		
		// //add pv;
		// PostsDetail::find($id)->increment('count_view');
		   	 		
		// //suggest post
		// $tags = PostsTagRelationships::where('post_id', $id)->get();
		// //var_dump($tags);
		// $tagarr = [];
		// foreach ($tags as $tag) {
		// 	$tagarr[] = $tag['post_tag_id'];

		// }
		
		//$relate = \DB::table('posts_tag_relationships')->whereIn('post_tag_id', $tagarr)->groupBy('post_id')->inRandomOrder()->limit(6)->get();
		// $relate = PostsTagRelationships::with('article')->where('post_id','!=', $id)->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(14)->get();	 		
		
		$posts = PostsDetail::with('hot')->orderBy('count_view', 'desc')->Paginate(12, null, 1, $page);
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();
		 
		if($posts) {
			$device = Utils::chkdevice();
			return view('app_rwd.index.default_hot',[
				'post'=> $article,
				'lastPage' => $lastPage,
				'currentPage' => $currentPage,
				'device' => $device,
				'posts'=> $posts,
				'title'=> '热门影片',
				'tag' => 'hot',
			]);
		} else {
			//沒有文章跳轉
			echo '沒有文章';
			header("Location:/"); 
		}
	}
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
		
		$posts = PostsTagRelationships::with('article')->with('hot')->where('post_tag_id', $tag)->where('status', 1)->orderBy('post_id', 'desc')->Paginate(12, null, 1, $page);
		
		//$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->with('commentsGod')->where('cate_id', $cats->id)->where('status', 1)->orderBy('id', 'desc')->Paginate(10, null, 1, $page);
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();

	    // $tagarr = [1,2,4,10,11];
		// $relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(10)->get();	 		
		//var_dump($posts);
		
		$device = Utils::chkdevice();
		return  view('app_rwd.index.default_tag', [
			'post'=> $article,
			'posts'=>$posts,
			'lastPage' => $lastPage,
			'currentPage' => $currentPage,
			'device' => $device,
			// 'relate' => $relate,
			'tag' => $tags->id,
			'title' => $tags->name
		]);	
		
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
		
		/*
		if($user == false) {
			header("Location:/") ;
			return ;		       
	    }
	    */
		$device = Utils::chkdevice();
		return view('app_rwd.index.postpagev2',[
			'tags' => $tags,
			'device' => $device,
			'postArticle' => true
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
	
}
