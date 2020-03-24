<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class CardsLogs extends Model
{
    protected $table = 'cards_logs';
    protected $fillable = [];
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}
