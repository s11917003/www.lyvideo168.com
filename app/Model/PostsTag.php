<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostsTag extends Modeli
{
    protected $table = 'posts_tag';
    protected $fillable = ['name','status','seo_title','seo_keys','seo_desc'];
    protected $primaryKey = 'id';
	public $timestamps = false;

}
