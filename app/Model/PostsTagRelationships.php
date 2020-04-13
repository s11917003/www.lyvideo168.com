<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;


class PostsTagRelationships extends Modeli
{
    protected $table = 'posts_tag_relationships';
    protected $fillable = ['post_id','post_tag_id', 'cate_id', 'status'];
    protected $primaryKey = 'post_id';
	public $timestamps = false;
	
	/*
    protected $casts = [
        'post_id' => 'integer',
        'post_tag_id' => 'integer',
    ];
    */
	
	
    public function setPostIdAttribute($postid)
    {

        if (is_array($postid)) {
            $this->attributes['post_id'] = implode(',', $postid);
        } else {
	        $this->attributes['post_id'] = $postid;
        }
    } 
      
	
    public function setPostTagIdAttribute($posttagid)
    {
        if (is_array($posttagid)) {
            $this->attributes['post_tag_id'] = implode(',', $posttagid);
        } else {
	        $this->attributes['post_tag_id'] = $posttagid;
        }
    }
     
	
    //關聯post_tag 名
    public function tagname() {
        return $this->hasOne('App\Model\PostsTag','id', 'post_tag_id');
    }

    public function post_tag_id() {
        return $this->hasOne('App\Model\PostsTag','id', 'post_tag_id');
    }    
    
    public function article() {
        return $this->hasOne('App\Model\PostsArticle','id', 'post_id')->with('detail')->with('tag')->with('commentsGod')->with('commentsNew')->with('userInfo')->where('status', 1)->where('covered', 1);
    }

    public function hot() {
        return $this->hasOne('App\Model\PostsDetail','id', 'post_id');
    }

    public function articleDetail() {
        return $this->hasOne('App\Model\PostsDetail','id', 'post_id');
    }
    
	//獲得熱神評論
	public function commentsGod() {
	      return $this->hasOne('App\Model\PostsComments', 'article_id', 'post_id')->with('userInfo')->where('count_digg','>','10')->orderby('created_at','desc');
	}    
}
