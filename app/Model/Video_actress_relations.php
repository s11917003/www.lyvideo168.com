<?php
namespace App\Model;
 
//use Illuminate\Database\Eloquent\Model;

class Video_actress_relations extends Modeli
{
    protected $table = 'video_actress_relations';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function tagRelations() 
    {
        return $this->hasOne(Video_actress::class, 'id', 'actress_id');
    }
}
