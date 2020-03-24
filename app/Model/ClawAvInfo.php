<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClawAvInfo extends Modeli
{
    protected $table = 'claw_av_info';
    protected $fillable = ['id','title','coverimg','idno','publish_time', 'detailurl', 'censored'];
    protected $primaryKey = 'id';
	public $timestamps = false;

}
