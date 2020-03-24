<?php

namespace App\Http\Controllers\Avdb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\Utils;
use App\Lib\User;
use App\Lib\UserDB;
use Carbon\Carbon;
use QL\QueryList;

use App\Model\ClawAvInfo;
use App\Model\ClawAvDetail;
use App\Model\PostsTagRelationships;


class IndexController extends Controller {

    
	public function index($page = 1) {
        
		$posts = ClawAvInfo::where('censored', 1)->orderBy('publish_time', 'desc')->Paginate(48, null, 1, $page);
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();
	    
		//return  view('app.index.default', [
		//var_dump($posts);

	    $tagarr = [1,2,4,10,11];
		$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(6)->get();	 	

		$device = Utils::chkdevice();

		return  view('app_rwd.index.avdb', [
			'posts'=>$posts,
			'lastPage' => $lastPage,
			'currentPage' => $currentPage,
			'loadmore' => true,
			'device' => $device,
			'relate' => $relate,
			'pagestring' => '/censord/'	
		]);
	}

	public function uncensord($page = 1) {
        
		$posts = ClawAvInfo::where('censored', 0)->orderBy('publish_time', 'desc')->Paginate(48, null, 1, $page);
		$lastPage = $posts->lastPage();
		$currentPage = $posts->currentPage();
	    
		//return  view('app.index.default', [
		//var_dump($posts);
	    $tagarr = [1,2,4,10,11];
		$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(6)->get();	 			
		
		$device = Utils::chkdevice();

		return  view('app_rwd.index.avdb', [
			'posts'=>$posts,
			'lastPage' => $lastPage,
			'currentPage' => $currentPage,
			'loadmore' => true,
			'device' => $device,
			'relate' => $relate,
			'pagestring' => '/uncensord/'	
		]);
	}
	
	public function avdbpostview($id) {
		$article = ClawAvDetail::find($id);
		if(!$article) {
			
			file_get_contents("http://www.gporn.cc/avdb/clawavdetail?id=$id");
			//header("Location:/");
			$article = ClawAvDetail::remember(360)->find($id);
			//return ;
		}

	    $tagarr = [1,2,4,10,11];
		$relate = PostsTagRelationships::with('article')->whereIn('post_tag_id', $tagarr)->where('status',1)->groupBy('post_id')->inRandomOrder()->limit(6)->get();	 	
		
		//var_dump($article);
		
		$device = Utils::chkdevice();
		return  view('app_rwd.index.avdbpview',[
			'post'=>$article,
			'device' => $device,
			'relate' => $relate
		]);
	}	
}