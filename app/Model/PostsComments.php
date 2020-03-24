<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class PostsComments extends Modeli
{
    protected $table = 'posts_comments';
    protected $fillable = ['user_id', 'article_id', 'parent_id', 'name', 'target_name', 'content', 'status'];
    //public $timestamps = false;

    //關聯user
    public function userInfo() {
        return $this->hasOne('App\Model\Users','user_id','user_id');
    }


	/**
	* 获得此评论所属的文章。
	*/
	public function article() {
		return $this->belongsTo('App\Model\PostsArticle')->with('detail')->with('tag')->with('user_info')->with('commentsGod')->with('commentsNew');
	}
	
	/**
	* 获得此评论所有的回复
	*/
	public function replys() {
		return $this->hasMany('App\Model\PostsComments', 'parent_id');
	}
	
	public function gotreply() {
		return $this->where('count_reply', '>', 100)->orderby('created_at', 'desc')->first();
	}
}
