<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
//use Illuminate\Database\Eloquent\Model;

class Video extends Modeli
{
    protected $table = 'video';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function tagRelations(): HasMany
    {
        return $this->hasMany(Video_tag_relations::class, 'video_id', 'id');
    }
}
