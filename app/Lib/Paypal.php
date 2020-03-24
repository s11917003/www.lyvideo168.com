<?php
namespace App\Lib;
use App\Model\GooglePaymentLog;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

class Paypal {
	
	public function requestUrl ($orderid, $licence, $pid) {
		
		if(!$orderid || !$licence || $pid ) {
			return false;
		}
		
		$provider = new ExpressCheckout;      // To use express checkout.
		$provider = \PayPal::setProvider('express_checkout');      // To use express checkout(used by default).
		
		//商品
		$itemlist = [
			'pid_1' => [
		        'name' => '1 month licence',
		        'price' => 99.99,
		        'qty' => 1				
			],
			
			'pid_2' => [
		        'name' => '1 week licence',
		        'price' => 49.99,
		        'qty' => 1						
			]
		];
		
		$data['items'] = $itemlist[$pid];
		$data['invoice_id'] = $orderid;
		$data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
		$data['return_url'] = url('/payment/success');
		$data['cancel_url'] = url('/event/app/en');
		$data['ipn_url']
		
		
		$total = 0;
		foreach($data['items'] as $item) {
		    $total += $item['price']*$item['qty'];
		}
		
		$data['total'] = $total;
		
		//give a discount of 10% of the order amount
		//$data['shipping_discount'] = round((10 / 100) * $total, 2);
		$response = $provider->setExpressCheckout($data);

		// Use the following line when creating recurring payment profiles (subscriptions)
		//$response = $provider->setExpressCheckout($data, true);
		
		 // This will redirect user to PayPal
		return $response['paypal_link'];
	}
	
	public function ipn() {

		
	}
	
}