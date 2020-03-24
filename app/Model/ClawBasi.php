<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class ClawBasi extends Model
{
    protected $table = 'claw_basi';
    protected $fillable = ['pid', 'text', 'tag'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}
