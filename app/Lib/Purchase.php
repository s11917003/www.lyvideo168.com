<?php
namespace App\Lib;
use App\Model\GooglePaymentLog;

class Purchase {
	public function getOrderId($prefix) {
		return $prefix . substr(date('YmdHis') . rand(100, 999), 2, 16);
	}
	
	public function addGooglePaymentLog($orderid, $authcode, $pid, $ip) {
		
		$gp = new GooglePaymentLog;
		$gp->order_id = $orderid;
		$gp->auth_code = $authcode;
		$gp->google_product_id = $pid;
		$gp->order_time = date('Y-m-d H:i:s');
		$gp->ip = $ip;
		$gp->save();
		
	}
	
	public function updateGooglePaymentLog($orderid, $data) {
		$gp = new GooglePaymentLog;
		$payinfo = $gp->find($orderid);
		
		foreach ($data as $key => $dd) {
			$payinfo->$key = $dd;
		}
		$payinfo->save();		
	}

}