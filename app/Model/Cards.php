<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    protected $table = 'cards';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}
