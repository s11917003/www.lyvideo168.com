<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GooglePaymentLog extends Modeli
{
    protected $table = 'google_payment_logs';
    protected $fillable = [];
    protected $primaryKey = 'order_id';
	public $incrementing = false;
	public $timestamps = false;

}
