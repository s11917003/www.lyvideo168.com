<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostsDigg extends Modeli
{
    protected $table = 'posts_digg';
    protected $fillable = ['user_id','post_id','status'];
    protected $primaryKey = 'user_id';
	public $timestamps = false;

}
