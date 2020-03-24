<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class PostsDetail extends Model
{
    protected $table = 'posts_detail';
    protected $fillable = [];
    public $timestamps = false;

	 public function hot() {
	 	return $this->hasOne('App\Model\PostsArticle','id','id')->with('tag');
	 }
	/**
	* 更新浏览量
	* @var [int]
	*/
	static public function update_view($id) {
	     $article = PostsDetail::findOrFail($id);
	     $article->count_view = $article->count_view + 1;
	     $article->update([
	         'count_view' => $article->count_view,
	     ]);
	}

	/**
	* 更新點贊
	* @var [int]
	*/
	static public function update_digg($id) {
		$article = PostsDetail::findOrFail($id);
		$article->count_digg = $article->count_digg + 1;
		$article->update([
			'count_digg' => $article->count_digg,
	    ]);
	}

	/**
	* 更新噓
	* @var [int]
	*/
	static public function update_bury($id) {
		$article = PostsDetail::findOrFail($id);
		$article->count_bury = $article->count_bury + 1;
		$article->update([
			'count_bury' => $article->count_bury,
	    ]);
	}

	/**
	* 更新播放次數
	* @var [int]
	*/
	static public function update_played($id) {
		$article = PostsDetail::findOrFail($id);
		$article->count_played = $article->count_played + 1;
		$article->update([
			'count_played' => $article->count_played,
	    ]);
	}

	/**
	* 更新分享次數
	* @var [int]
	*/
	static public function update_share($id) {
		$article = PostsDetail::findOrFail($id);
		$article->update_share = $article->update_share + 1;
		$article->update([
			'update_share' => $article->update_share,
	    ]);
	}
	
	/**
	* 更新评论量
	* @var [int]
	*/
	static public function update_comment($id) {
		$article = PostsDetail::findOrFail($id);
		$article->count_cmt = $article->count_cmt + 1;
		$article->update([
			'count_cmt' => $article->count_cmt,
	    ]);
	}

	    
}
