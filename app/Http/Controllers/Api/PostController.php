<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\PostsArticle;
use App\Model\PostsCategory;
use App\Model\PostsDetail;
use App\Model\PostsTag;
use App\Model\Footer;
use App\Model\PostsTagRelationships;
use App\Model\PostsComments;
use App\Model\PostsCommentsLog;
use App\Model\AdArticle;

use App\Lib\User;


class PostController extends Controller {
	//最新
	public function index(Request $request, $page = 1) {
		$cateid = $request->input('cate');
		//$category = PostsCategory::all();
		$posts = PostsArticle::with('detail')->with('tag')->with('userInfo')->where('cate_id', $cateid)->where('status', 1)->where('covered', 1)->orderBy('id', 'desc')->Paginate(16, null, 1, $page);		
				
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();
	    
	    return response()->json($posts->toArray());
	}

	//熱門
	public function hotlist(Request $request, $page = 1) {
		//$cateid = $request->input('cate');
		//$category = PostsCategory::all();
		$posts = PostsDetail::with('hot')->where('count_view','>',20)->orderBy('count_view', 'desc')->Paginate(16, null, 1, $page);		
				
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();
	    
	    return response()->json($posts->toArray());
	}
	

	public function show_api($id) {
	    $article = PostsArticle::remember(60)->with('detail')->with('tag')->with('userInfo')->where('id',$id)->where('status', 1)->first();
	    //var_dump($article);
	    		//add pv;
		PostsDetail::find($id)->increment('count_view');
	    
	    return response()->json([
		    'content' => $article
	    ]);
	    
	    //return ;
	}
	
	public function getTagList() {
		$tags = PostsTag::remember(60)->where('status', 1)->orderby('term_order', 'desc')->get();
	    return response()->json([
		    'content' => $tags
	    ]);				
	}
	

	//標籤
	public function tag($tag, $page = 1	) {
		$tags = PostsTag::where('id', $tag)->first();		
		if($tags == null) {
			return ;
		}			
		
		$posts = PostsTagRelationships::remember(60)->with('article')->where('post_tag_id', $tag)->where('status', 1)->orderBy('post_id', 'desc')->Paginate(16, null, 1, $page);
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();
		
				
		return response()->json($posts->toArray());
	}
	
	public function getRelate($id) {
		
		$tags = PostsTagRelationships::where('post_id', $id)->get();
		//var_dump($tags);
		$tagarr = [];
		foreach ($tags as $tag) {
			$tagarr[] = $tag['post_tag_id'];

		}
		
		$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(8)->get();
		
	    return response()->json($relate->toArray());
	}
	
		
}
