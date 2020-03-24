<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClawAvDetail extends Modeli
{
    protected $table = 'claw_av_detail';
    protected $fillable = ['id','title','bigimg','publish_time', 'idno', 'video_len','director','publisher','producer','typestring','tagstring','censored','avname'];
    protected $primaryKey = 'id';
	public $timestamps = false;

}
