<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class PaypalPaymentLog extends Modeli
{
    protected $table = 'paypal_payment_logs';
    protected $fillable = [];
    protected $primaryKey = 'order_id';
	public $incrementing = false;
	public $timestamps = false;

}
