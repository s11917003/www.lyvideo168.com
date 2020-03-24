<?php
namespace App\Http\Controllers\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\UserAuth;
use App\Lib\Utils;
use App\Model\UserAuthVO;
use App\Model\PaypalPaymentLog;

use App\Lib\Purchase;

use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;


class PaymentController extends Controller {
	
	public function index(Request $request) {
		
		$licence = $request->input('licence');		
		//echo 'paypal支付首頁';
    	return view('event.download.paypal', [
	    	'licence' => $licence
    	]);
	}
	
	public function request(Request $request) {
		
		$licence = $request->input('licence');
		$product = $request->input('product');
		
		if(!$licence) {
			$msg = 'Params Error!';
			return redirect("/event/app/payment/paypal/finish?orderid=&licence=&msg=$msg");
		}
		
		//chk licence code is exsist
		$info = UserAuthVO::find($licence);
		if(!$info) {
			$msg = 'Exist Licence!';
			return redirect("/event/app/payment/paypal/finish?orderid=&licence=&msg=$msg");
		}
		
		//chk item_select  
		if($product != 'pid_1' && $product != 'pid_2') {
			$product = 'pid_2';
		}
		
		//建立訂單記錄
		$p = new Purchase;
		$orderid = $p->getOrderId('P');
		
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
		
		$data['items'] = [$itemlist[$product]];
		$data['invoice_id'] = $orderid;
		$data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
		$data['return_url'] = url('/event/app/payment/paypal/success');
		$data['cancel_url'] = url('/event/app/en');
		
		//var_dump($data['items']);
		$total = 0;
		foreach($data['items'] as $item) {
		    //var_dump($item['price']);
		    $total += $item['price']*$item['qty'];
		}
		
		$data['total'] = $total;
		//var_dump($data);
		
		//give a discount of 10% of the order amount
		//$data['shipping_discount'] = round((10 / 100) * $total, 2);
		$response = $provider->setExpressCheckout($data);
		
		//Log 
		$pp = new PaypalPaymentLog;
		$pp->order_id = $orderid;
		$pp->licence_code = $licence;
		$pp->product_id = $product;
		$pp->paypal_token = $response['TOKEN'];
		$pp->order_time = date('Y-m-d H:i:s');
		$pp->amount = $data['total'];
		$pp->ip = Utils::getIp();
		$pp->save();
				
		//充值跳轉
		//echo '支付請求';
		return redirect($response['paypal_link']);
		
	}
	
	public function ipn(Request $request) {
		    // Import the namespace Srmklive\PayPal\Services\ExpressCheckout first in your controller.
		    $provider = new ExpressCheckout;
		    $request->merge(['cmd' => '_notify-validate']);
		    $post = $request->all();        
			\Log::info($post);

		    $response = (string) $provider->verifyIPN($post);
		    if ($response === 'VERIFIED') {
				
				\Log::info($post);
				
		        // Your code goes here ...
		        echo '正確';
		        return ;
		    }
		    
		    echo '錯誤';
		    return ;
	}
	
	public function success(Request $request) {
		
		//$recurring = ($request->get('mode') === 'recurring') ? true : false;
		
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        
        if(!$token || !$PayerID) {
	        $msg = 'Params Error!';
			return redirect("/event/app/payment/paypal/finish?orderid=&licence=&msg=$msg");
        }
        
        $tokeninfo = PaypalPaymentLog::where('paypal_token', $token)->first();
        if(!$tokeninfo) {
	        $msg = 'Invalid Order Id';
			return redirect("/event/app/payment/paypal/finish?orderid=&licence=&msg=$msg");
        }
        
        if($tokeninfo->finish_time != null) {
	        $msg = 'Finished Order Id';
			return redirect("/event/app/payment/paypal/finish?orderid=&licence=&msg=$msg");
        }
        
		$cart = $this->getCheckoutData($tokeninfo->order_id, $tokeninfo->product_id);
		        
        // Verify Express Checkout Token
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
			
			$tokeninfo->payer_id = $PayerID;
			$tokeninfo->save();
			
			//var_dump($response);
            // Perform transaction on PayPal
            $payment_status = $provider->doExpressCheckoutPayment($cart, $token, $PayerID);
	        $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
           
           //var_dump($payment_status);
           if($status == 'Completed') {
				$tokeninfo->pay_time = date('Y-m-d H:i:s');
				$tokeninfo->save();
				//增加時間
				
				if($tokeninfo->product_id == 'pid_2') {
					$day = '7';
				}

				if($tokeninfo->product_id == 'pid_1') {
					$day = '30';
				}			
				
				
				$ua = new UserAuth();
				$ret = $ua->bindlicencel($tokeninfo->licence_code, $day);
				
				if($ret) {
					$tokeninfo->finish_time = date('Y-m-d H:i:s');
					$tokeninfo->save();
				
					return redirect("/event/app/payment/paypal/finish?orderid=$tokeninfo->order_id&licence=$tokeninfo->licence_code&msg=success");
				} else {
	           		$msg = '充值成功加值失敗，請聯繫客服';
			   		return redirect("/event/app/payment/paypal/finish?orderid=&licence=&msg=$msg");					
				}
				//echo '支付完成';
           } else {

           }
           
           
           /*
            $invoice = $this->createInvoice($cart, $status);
            if ($invoice->paid) {
                //session()->put(['code' => 'success', 'message' => ""]);
				echo "success Order $invoice->id has been paid successfully!";

            } else {
	            echo "Error processing PayPal payment for Order $invoice->id!";
            }
            */
        }
	}
	

    protected function getCheckoutData($orderid, $product)
    {
        $data = [];
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
		
		$data['items'] = [$itemlist[$product]];		
		$data['return_url'] = url('/event/app/payment/paypal/finish');
        $data['invoice_id'] = $orderid;
        $data['invoice_description'] = "Order #$orderid Invoice";        
		$data['cancel_url'] = url('/event/app/en');
        
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $data['total'] = $total;
        return $data;
    }
	
	/*
	protected function createInvoice($cart, $status)
    {
        $invoice = new Invoice();
        $invoice->title = $cart['invoice_description'];
        $invoice->price = $cart['total'];
        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
            $invoice->paid = 1;
        } else {
            $invoice->paid = 0;
        }
        $invoice->save();
        collect($cart['items'])->each(function ($product) use ($invoice) {
            $item = new Item();
            $item->invoice_id = $invoice->id;
            $item->item_name = $product['name'];
            $item->item_price = $product['price'];
            $item->item_qty = $product['qty'];
            $item->save();
        });
        return $invoice;
    }
    */
    
    public function finish(Request $request) {
	    
	    $msg = $request->input('msg');
	    $orderid = $request->input('orderid');
	    $licence = $request->input('licence');
	    
		return view('event.download.finish',[
			'orderid' => $orderid,
			'msg' => $msg,
			'licence' => $licence
		]);
    }
	
}