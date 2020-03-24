<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostsFilterWord extends Model
{
    protected $table = 'posts_filter_word';
    protected $fillable = ['id','word'];
    protected $primaryKey = 'id';
	public $timestamps = false;

}
