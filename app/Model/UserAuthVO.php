<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAuthVO extends Modeli
{
    protected $table = 'user_auth';
    protected $fillable = [];
    protected $primaryKey = 'licence_code';
	public $incrementing = false;
	public $timestamps = false;

}
