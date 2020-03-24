<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cards;
use App\Lib\UserAuth;
use App\Lib\GoogleRsaChk;
use App\Lib\Purchase;
use App\Lib\Utils;
use App\Model\GooglePaymentLog;
use App\Model\CardsLogs;

class AuthController extends Controller {
	
	private $apprsa = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAhSEtA3yY33FgKbPbfHtJUzQ/9M6PmevVya4IfNhG+f76L67QkKaTxG5tgAAWkWFJQDjMPMf8fqb19SiNKB4fjPM9kq8G+gvAjCVBGCNgxi38JAeEze0Wn8LjGeidHfsNkOfWCjbPU9WeskBK89fM/3mnG2do60B59aseNVlxmhSbcEbyFoXnDbY4nuiTQlrUAfkG7Mc60ivMaW+htRHYFBJkhfkaBxqh7RBIzEY0blcau3R0LKDBf9x2lM3sPlHjl1ZeWl66a5lt3fWzxRqiOfIXWLhf8Rrc6/rr6BHf8idyYbFTF1onZKsecObOYeIL7iXOmdWqzfopco4L694g6QIDAQAB';
	
	public function getauthcode() {
		
		$ua = new UserAuth;
		$authcode = $ua->genAuthCode();
		$licence = $ua->bindlicence($authcode, 0.125);
		
		if($authcode) {
			return response()->json([
				'ret'=> 1,
				'auth'=> $licence[1],
				'licence'=> $licence[0],
			]); 	
		} else {
			return response()->json([
				'ret'=> 0,
				'msg'=> 'Unknown Error!'
			]); 			
		}

	}
	
	public function chklicence(Request $request) {
		$licence = $request->input('licence');
		$authcode = $request->input('authcode');
		
		if(!$licence || !$authcode) {
			return response()->json([
				'ret'=> 0,
				'msg'=> 'Param Error!'
			]); 
		}
		$ua = new UserAuth;
		$newauthcode = $ua->varifyLicenceCode($licence, $authcode);
		if($newauthcode) {
			return response()->json([
				'ret'=> 1,
				'auth' => $newauthcode[0],
				'expire' => $newauthcode[1]
			]); 			
		} else {
			return response()->json([
				'ret'=> 0,
				'msg'=> 'Expired Licence!'
			]); 			
		}
 		
	}
	
	public function paymentrequest(Request $request) {
		$authcode = $request->input('authcode');
		$pid = $request->input('itemid');
			
		if(!$authcode) {
			return response()->json([
				'ret'=> 0,
				'msg' => 'Request Error!'
			]); 			
		}
		
		$p = new Purchase;
		$orderid = $p->getOrderId('G');
		$p->addGooglePaymentLog($orderid, $authcode, $pid, Utils::getIp());
		
		return response()->json([
			'ret'=> 1,
			'orderid' => $orderid,
		]); 	
	}
	
	public function paymentvarify(Request $request) {
		$authcode = $request->input('authcode');
		$signatureAndroid = $request->input('signatureAndroid');
		$purchaseToken = $request->input('purchaseToken');
		$dataAndroid = $request->input('dataAndroid');
		$transactionDate = $request->input('transactionDate');
		$transactionId = $request->input('transactionId');
		$productId = $request->input('productId');
		$transactionReceipt = $request->input('transactionReceipt');
		$orderid = $request->input('orderid');
		
		\Log::info("$transactionReceipt, $signatureAndroid");
		
		//更新db資料
		$updatedata = [
			'google_token' => $purchaseToken,
			'google_order_id' => $transactionId,
			//'pay_time' => date('Y-m-d H:i:s')
		];
		
		$gp = new GooglePaymentLog;
		$payinfo = $gp->find($orderid);
		
		if($payinfo->finish_time != NULL) {
			return response()->json([
				'ret'=> 0,
				'msg' => 'Error!',
			]); 				
		}
		
		$transactionReceiptarr = json_decode($transactionReceipt, true);
		$productid = $transactionReceiptarr['productId'];
		
		if($payinfo->google_product_id != $productid) {
			return response()->json([
				'ret'=> 0,
				'msg' => 'Error!',
			]); 			
		}
		
		$p = new Purchase;
		$p->updateGooglePaymentLog($orderid, $updatedata);
				
		$gr = new GoogleRsaChk;
		$gr->setPubKey($this->apprsa);
		$chk = $gr->verify($transactionReceipt, $signatureAndroid);
		\Log::info($chk);
		
		if($chk == 1) {
			//支付成功 紀錄
			$p->updateGooglePaymentLog($orderid, ['pay_time' => date('Y-m-d H:i:s')]);
			
			//支付成功 充值時間
			$productday = [
				'cacu_150' => 1,
				'cacu_900' => 7,
				'cacu_3000' => 30	
			];
			$day = $productday[$productid];
			
			$ua = new UserAuth;
			$licence = $ua->bindlicence($authcode, $day);
			//\Log::info("licence_data: $licence");
			
			$finishdata = [
				'licence_code' => $licence[0],
				'finish_time' => date('Y-m-d H:i:s')
			];
			
			$p->updateGooglePaymentLog($orderid, $finishdata);
			
			
			return response()->json([
				'ret'=> 1,
				'licence' => $licence[0],
				'authcode' => $licence[1],
			]); 				
		} else {
			return response()->json([
				'ret'=> 0,
				'msg' => 'Error!',
			]); 			
		}
	}
	
	public function coupon(Request $request) {
		$coupon = $request->input('coupon');
		$licence = $request->input('licence');
		$authcode = $request->input('authcode');
		
		if(!$licence || !$authcode || !$coupon) {
			return response()->json([
				'ret'=> 0,
				'msg'=> 'Param Error!'
			]); 
		}
		
		$ret = Cards::where('card_pwd', $coupon)->first();
		if(!$ret) {
			//錯誤的key
			return response()->json([
				'ret'=> 0,
				'msg'=> 'Inputed Coupon is not Exist'
			]);			
		}
		
		if($ret->licence_code != NULL && $ret->type == 1) {
				//key已被綁定
			return response()->json([
				'ret'=> 0,
				'msg'=> 'Inputed Coupon has be Used'
			]);
		}

		//檢查coupon log是否已使用
		$cardlog = CardsLogs::where('licence_code', $licence)->where('card_pwd', $coupon)->first();
		if($cardlog) {
			return response()->json([
				'ret'=> 0,
				'msg'=> 'Already Used'
			]);				
		} 

		//檢查訊號時效
		$now = time();
		$usedtime = strtotime($ret->expird_time);
		if( ($now - $usedtime) >  0) {
			return response()->json([
				'ret'=> 0,
				'msg'=> 'Expired Coupon'
			]);				
		}
		
		$ua = new UserAuth;
		$newauthcode = $ua->varifyLicenceCode($licence, $authcode);
		if($newauthcode == false) {
			return response()->json([
				'ret'=> 0,
				'msg'=> 'Expired Licence!'
			]); 			
		}
		
		$authcode = $newauthcode[0];

		//個人序號才需要驗證
		if($ret->type == 1) {						
					
			//寫入
			$ret->licence_code = $licence; //調整為licence
			//$ret->expird_time = date('Y-m-d h:i:s');
			$ret->save();
			
			//打log
			$cl = new CardsLogs;
			$cl->licence_code = $licence;
			$cl->card_pwd = $coupon;
			$cl->used_time = date('Y-m-d h:i:s');
			$cl->save();
			 
			//增加時間
			$ua = new UserAuth;
			$bind = $ua->bindlicence($authcode, $ret->days);
			
		
			return response()->json([
				'ret'=> 1,
				'licence' => $bind[0],
				'authcode' => $bind[1],
				'msg'=> 'Success!'
			]);				
		} else {
			//打log
			$cl = new CardsLogs;
			$cl->licence_code = $licence;
			$cl->card_pwd = $coupon;
			$cl->used_time = date('Y-m-d h:i:s');
			$cl->save();
			
			//增加時間
			$ua = new UserAuth;
			$bind = $ua->bindlicence($authcode, $ret->days);
			
			//var_dump($licence);
						
			return response()->json([
				'ret'=> 1,
				'licence' => $bind[0],
				'authcode' => $bind[1],
				'msg'=> 'Success!'
			]);
		}		
		//檢查序號是否使用
	}
	
	//----- 以下待更新 ---- //
	
	
	public function bindcards(Request $request) {
		$key = $request->input('pwd');
		if(!$key) {
			return response()->json([
				'ret'=> 0,
				'msg'=> '錯誤的參數'
			]);
		}
		
		$ret = Cards::where('card_pwd', $key)->first();
		//var_dump($ret->auth_code);
		
		if(!$ret) {
			//錯誤的key
			return response()->json([
				'ret'=> 0,
				'msg'=> '錯誤的序號'
			]);			
		}

		//檢查訊號時效
		$now = time();
		$usedtime = strtotime($ret->used_time);
		if( ($now - $usedtime) >  $ret->days * 1000 * 3600 * 24) {
			return response()->json([
				'ret'=> 0,
				'msg'=> '序號已過期'
			]);				
		}		
		
		//個人序號才需要驗證
		if($ret->type == 1) {
			if($ret->auth_code != NULL) {
				//key已被綁定
				return response()->json([
					'ret'=> 0,
					'msg'=> '您輸入的序號已被綁定'
				]);
			}
			
			//生成一個登入authcode
			$authcode = $this->genAuthCode();
		
			//寫入
			$ret->auth_code = $authcode;
			$ret->used_time = date('Y-m-d h:i:s');
			$ret->save();
		
			return response()->json([
				'ret'=> 1,
				'key' => $key,
				'authcode' => $authcode,
				'msg'=> '綁定成功'
			]);				
		} else {
			return response()->json([
				'ret'=> 1,
				'key' => $key,
				'authcode' => 'public',
				'msg'=> '綁定成功'
			]);
		}		
	}
	
	public function varify(Request $request) {
		$key = $request->input('pwd');
		$authcode = $request->input('authcode');
		
		if(!$key || !$authcode) {
			return response()->json([
				'ret'=> 0,
				'msg'=> '錯誤的參數'
			]);			
		}
		
		$ret = Cards::where('card_pwd', $key)->where('auth_code', $authcode)->first();
		if(!$ret) {
			return response()->json([
				'ret'=> 0,
				'msg'=> '驗證錯誤'
			]);				
		}
		
		if($ret->state == 0) {
			return response()->json([
				'ret'=> 0,
				'msg'=> '序號已已失效'
			]);				
		}
		
		//檢查訊號時效
		$now = time();
		$usedtime = strtotime($ret->used_time);
		if( ($now - $usedtime) >  $ret->days * 1000 * 3600 * 24) {
			return response()->json([
				'ret'=> 0,
				'msg'=> '登入授權過期'
			]);				
		}
		
		//刷新authcode
		if($ret->type == 1) {
			$authcode = $this->genAuthCode();
			$ret->auth_code = $authcode;
			$ret->save();
			
			return response()->json([
				'ret'=> 1,
				'key' => $key,
				'authcode' => $authcode,
				'msg'=> '登入成功',
			]);				
		} else {
			return response()->json([
				'ret'=> 1,
				'key' => $key,
				'authcode' => 'public',
				'msg'=> '登入成功',
			]);
		}		
 	}
	
	/*
	private function genAuthCode() {
		$t = time();
		$key = 'gporn';
		$authcode = md5($t.$key.$this->random_str(4));
		
		return $authcode;
	}
	*/
	
	private function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
	    }
	    return $str;
	}
	
	/*
	{ autoRenewingAndroid: false,
      signatureAndroid: 'FA7/1TRaXGdeCPYfeF1KxPG0sOEo1gZC0NEqXdWlx5HSVgcdK0ts+PtCLBZWZXJd4TTlaGYBW9n0/9j1Z0khANjXF2lyGxKKpbUPZs+DyCnqKmu49/A4JBJ1Sga6rP1g5TMvK98tSaBunYfQxzjRIyF8fDEhb1mbhutAhMncElrSF7iZKdLpN3mwPQ2z9DC/1QuxjB4nKmZpBjLxYCJUD0SPy2UmyTK3UguWhR/V+eYetLM9GCTzn+wZI59r/7GVtb1w6TkuqL7/Gwuuc7YO3PUI9oi4kF3yIEp8f6kHHF29e29n95FEQsQQ3bJWd5QdDzfvFE9MylrRwHgPbbwaUw==',
      purchaseToken: 'kjfodkgdfnfmhihbpdphlhac.AO-J1Oy1GJdHM8BQjOdpy3JmE5p0iqg6TE_iNABrr9EC09UH3lRtvgIsVWEATL6KZ76S__uUHUzJRrUYxxQj8Bybz3qxxota9TzeeIcNlslWvP9QsLwZ1DxaGh3yqIww5IYV2EO_wAQf',
      dataAndroid: '{"orderId":"GPA.3347-3722-7343-30108","packageName":"richway.simplecacu.apk","productId":"cacu_150","purchaseTime":1539758554016,"purchaseState":0,"purchaseToken":"kjfodkgdfnfmhihbpdphlhac.AO-J1Oy1GJdHM8BQjOdpy3JmE5p0iqg6TE_iNABrr9EC09UH3lRtvgIsVWEATL6KZ76S__uUHUzJRrUYxxQj8Bybz3qxxota9TzeeIcNlslWvP9QsLwZ1DxaGh3yqIww5IYV2EO_wAQf"}',
      transactionReceipt: '{"orderId":"GPA.3347-3722-7343-30108","packageName":"richway.simplecacu.apk","productId":"cacu_150","purchaseTime":1539758554016,"purchaseState":0,"purchaseToken":"kjfodkgdfnfmhihbpdphlhac.AO-J1Oy1GJdHM8BQjOdpy3JmE5p0iqg6TE_iNABrr9EC09UH3lRtvgIsVWEATL6KZ76S__uUHUzJRrUYxxQj8Bybz3qxxota9TzeeIcNlslWvP9QsLwZ1DxaGh3yqIww5IYV2EO_wAQf"}',
      transactionDate: '1539758554016',
      transactionId: 'GPA.3347-3722-7343-30108',
      productId: 'cacu_150' }
    */
}