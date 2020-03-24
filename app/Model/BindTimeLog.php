<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class BindTimeLog extends Model
{
    protected $table = 'bind_time_log';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}
