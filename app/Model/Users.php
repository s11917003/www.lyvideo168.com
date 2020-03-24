<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = [];
    protected $primaryKey = 'user_id';
    //public $timestamps = false;
	protected $hidden = ['password'];

}
