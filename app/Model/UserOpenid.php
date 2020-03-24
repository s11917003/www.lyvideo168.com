<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class UserOpenid extends Model
{
    protected $table = 'users_openid';
    protected $fillable = [];
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    
}
