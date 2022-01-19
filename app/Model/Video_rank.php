<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
//use Illuminate\Database\Eloquent\Model;

class Video_rank extends Modeli
{
    protected $table = 'video_rank';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function video()
    {  
        return $this->hasMany(Video::class, 'video_id', 'video_id');
    }
}
