<?php
namespace App\Model;
//use Illuminate\Database\Eloquent\Model;

class Announcement extends Modeli
{
    protected $table = 'announcement';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false; 
}
