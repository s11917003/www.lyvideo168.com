<?php
namespace App\Model;
//use Illuminate\Database\Eloquent\Model;

class Video_tag_relations extends Modeli
{
    protected $table = 'video_tag_relations';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;

     //關聯videoTag
     public function tagName() {
        return $this->hasOne('App\Model\Video_tag','id','tag_id');
    }
}
