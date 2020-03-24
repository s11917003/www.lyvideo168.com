<?php
namespace App\Model;
//use Illuminate\Database\Eloquent\Model;

class PostsArticle extends Modeli
{
    protected $table = 'posts_article';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    //關聯user
    public function userInfo() {
        return $this->hasOne('App\Model\Users','user_id','user_id')->select(['user_id', 'nick_name', 'avatar']);
    }

    public function user_info() {
        return $this->hasOne('App\Model\Users','user_id','user_id')->select(['user_id', 'nick_name', 'avatar']);
    }    
    
    //關聯post_detail 資訊
    public function detail() {
        return $this->hasOne('App\Model\PostsDetail','id');
    }
    
    //關聯tag
    public function tag() {
	    return $this->hasMany('App\Model\PostsTagRelationships','post_id', 'id')->with('tagname');
    }

    //關聯ttag
    public function ttag() {
	    return $this->hasOne('App\Model\PostsTagRelationships','post_id', 'id')->with('tagname');
    }    
	
	//獲得一般評論
	public function comments() {
	      return $this->hasMany('App\Model\PostsComments', 'article_id', 'id');
	}
	
	//獲得熱門評論 36小時內回覆
	public function commentsHot() {
	      return $this->hasMany('App\Model\PostsComments', 'article_id', 'id')->whereRaw("TIMESTAMPDIFF(HOUR, NOW() , posts_comments.created_at) < 36")->where('count_digg','>','50');
	}

	//獲得熱神評論
	public function commentsGod() {
	      return $this->hasOne('App\Model\PostsComments', 'article_id', 'id')->with('userInfo')->where('count_digg','>','10')->orderby('created_at','desc')->limit(1);
	}
	
	//獲得最新一般評論
	public function commentsNew() {
	      return $this->hasOne('App\Model\PostsComments', 'article_id', 'id')->with('userInfo')->orderby('created_at','desc');
	}	
}
