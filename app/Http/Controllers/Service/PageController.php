<?php
namespace App\Http\Controllers\Service;
use App\Http\Controllers\Controller;
use App\Lib\Utils;

class PageController extends Controller
{
	public function important() {
		$device = Utils::chkdevice();
		return  view('app_rwd.service.important',[
			'device' => $device
		]);

	}
	
	public function privacy() {
		$device = Utils::chkdevice();		
		return  view('app_rwd.service.privacy',[
			'device' => $device
		]);

	}


	public function dmca() {
		$device = Utils::chkdevice();

		return  view('app_rwd.service.dmca',[
			'device' => $device
		]);

	}
	
	public function report($id) {
		
		//echo $id;
		return response()->json([
			'ret' => '1',
			'msg' => '感謝您的回報，相關人員將針對編號『'.$id.'』發文進行審查'
		]);
		
	}
	
	public function linkexchange() {
		$device = Utils::chkdevice();
		return  view('app_rwd.index.linkexchange',[
			'device' => $device
		]);
	}
} 
