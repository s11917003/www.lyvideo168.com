<?php
namespace App\Model;
//use Illuminate\Database\Eloquent\Model;

class Video_actress_data extends Modeli
{
    protected $table = 'video_actress_data';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getJapaneseNameAttribute($value)
    {
        return strtoupper($value);
    }
}