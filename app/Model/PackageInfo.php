<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class PackageInfo extends Model
{
    protected $table = 'package_info';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;

}
