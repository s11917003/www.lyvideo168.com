<?php
namespace App\Http\Controllers\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Lib\User;
use App\Model\PostsArticle;
use App\Model\PostsDetail;
use App\Model\PostsComments;
use App\Model\PostsCommentsLog;


class SnsAppController extends Controller {

	public function snsclick(Request $request) {
		$this->validate($request,[
	        'userid' => 'required',
	        'type' => 'required',
		]);	    		
		 
		$userid = $request->input('userid');		
		//判斷點擊
		$type = $request->input('type');
		//$kind = $request->input('kind');
		$typearr = explode('-', $type);
		$kind = $typearr[0];
		$action = $typearr[1];
		$postid = $typearr[2];
		
		if($action != 'digg' && $action != 'bury') {
			return ;
		}
		
		switch($kind) {
			case 'post':
				$post = PostsArticle::find($postid);
				if(!$post) {
					return response()->json([
					    'ret' => -1,
					    'msg' => '未知的錯誤A'
					]); 					
				}
				
				//新增點贊紀錄
				$count = $this->digg($postid, $kind, $action, $userid);
				if($count == false) {
					return response()->json([
					    'ret' => -3,
					    'kind' => $kind,
						'msg' => '您已點評過囉！'
					]); 
				}
			break;
		
			case 'reply':
				$commt = PostsComments::find($postid);
				if(!$commt) {
					return response()->json([
					    'ret' => -1,
					    'msg' => '未知的錯誤B'
					]); 					
				}
				
				//新增評論點贊紀錄
				$count = $this->rdigg($postid, $kind, $action, $userid);
				if($count == false) {
					return response()->json([
					    'ret' => -3,
					    'kind' => $kind,
						'msg' => '您已點評過囉！'
					]); 
				}					
			break;
			
			default:
				return response()->json([
				    'ret' => -1,
				    'msg' => '未知的錯誤xx'
				]); 			
			break;
		}
		
		return response()->json([
		    'ret' => 1,
		    'kind' => $kind,
		    'count' => $count
		]); 
		
	}
	
	//發文點贊或噓
	public function digg($postid, $kind, $action, $user) {
		if($kind == 'post') {			
			$data = \DB::table('posts_comments_log')
					->where('user_id', $user)
					->where('kind', $kind)
					->where('action', $action)
					->where('post_id', $postid)
					->first();
										
			if($data == NULL) {
				$pd = PostsDetail::find($postid);
				if($action == 'digg') {
					$pd->count_digg+=1;
					$count = $pd->count_digg;
				}
				if($action == 'bury') {
					$pd->count_bury+=1;
					$count = $pd->count_bury;
				}
				$pd->save();
				PostsCommentsLog::create(['user_id' => $user, 'kind'=> $kind, 'post_id'=> $postid, 'action' => $action]);

			} else {
				return false;
			}
		}
		
		return $count;
	}

	public function rdigg($postid, $kind, $action, $user) {
		if($kind == 'reply') {			
			$data = \DB::table('posts_comments_log')
					->where('user_id', $user)
					->where('kind', $kind)
					->where('action', $action)
					->where('post_id', $postid)
					->first();
										
			if($data == NULL) {
				$pd = PostsComments::find($postid);
				if($action == 'digg') {
					$pd->count_digg+=1;
					$count = $pd->count_digg;
				}
				if($action == 'bury') {
					$pd->count_bury+=1;
					$count = $pd->count_bury;
				}
				$pd->save();
				PostsCommentsLog::create(['user_id' => $user, 'kind'=> $kind, 'post_id'=> $postid, 'action' => $action]);

			} else {
				return false;
			}
		}
		
		return $count;
	}

	
	public function share() {
		
	}
	
	public function comment() {
		
	}
}