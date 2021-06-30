<?php
namespace App\Model;
//use Illuminate\Database\Eloquent\Model;

class Video extends Modeli
{
    protected $table = 'video';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
