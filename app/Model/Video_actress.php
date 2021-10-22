<?php
namespace App\Model;
//use Illuminate\Database\Eloquent\Model;

class Video_actress extends Modeli
{
    protected $table = 'video_actress';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getJapaneseName1Attribute($value)
    {
        return strtoupper($value);
    }
     //關聯videoTag
     public function actressRelations() {
        return $this->hasMany('App\Model\Video_actress_relations','actress_id','id');
    }
    //關聯videoTag
    public function wiki() {
        return $this->hasOne('App\Model\Video_actress_data','JapaneseName','JapaneseName1');
    }
   
}
