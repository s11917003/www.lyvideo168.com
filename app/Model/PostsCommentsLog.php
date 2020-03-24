<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class PostsCommentsLog extends Modeli
{
    protected $table = 'posts_comments_log';
    protected $fillable = ['user_id','kind','post_id','action'];
	protected $primaryKey = 'id';

    public $timestamps = true;
    
    public function article() {
		return $this->belongsTo('App\Model\PostsArticle', 'post_id')->with('detail')->with('tag')->with('user_info')->with('commentsGod')->with('commentsNew');
	}
	

}
