<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdLaunch;
use App\Model\AdDetailBanner;

use App\Model\PackageInfo;


class AppConfigController extends Controller {
	public function getVersion(Request $request) {
		$device = $request->input('device');
		$pkgname = $request->input('pkgname');
		
		//\Log::info($device, $pkgname);
		$config = PackageInfo::where('device', $device)->where('pkg_name', $pkgname)->first();
		if($config) {
			return response()->json([
				'ret'=>1,
				'ver' => $config->version_code,
				'device' => $config->device,
				'force' => $config->force_update
			]);
		} else {
			return response()->json([
				'ret'=>1,
				'ver' => $config->version_code,
				'device' => 'apk',
				'force' => 0
			]);			
		}
	}
	
	
	public function getconfig() {
		return response()->json([
			'cad' => [
				'display' => false,
				'img' => 'https://www.c8c8tv.com/img/addemo.jpg',
				'link' => 'https://www.c8c8tv.com',
				'timer' => 5,
			]
		]);
	}
	
	//蓋板
	public function getconfigAndroid() {
		$ret = AdLaunch::remember(60)->cacheTags('app_apk_config')->inRandomOrder()->where('type', 'apk')->where('status',1)->first();
		
		if($ret) {
			if($ret->play_url == null) {
				$link = $ret->web_url;
			} else {
				$link = $ret->play_url;
			}
			
			return response()->json([
				'cad' => [
					'display' => (bool)$ret->status,
					'id' => $ret->id,
					'app' => $ret->app_name,
					'icon' => $ret->app_icon,
					'img' => $ret->bg_img,
					'video' => $ret->video,
					'link' => $link,
					'timer' => $ret->timer,
				]
			]);
		}

		return response()->json([
			'ret' => false
		]);	
	}
	
	//蓋板
	public function getconfigIos() {
		$ret = AdLaunch::remember(60)->cacheTags('app_ios_config')->inRandomOrder()->where('type', 'ios')->where('status',1)->first();
		//var_dump($ret);
		
		if($ret) {
			if($ret->ios_url == null) {
				$link = $ret->web_url;
			} else {
				$link = $ret->ios_url;
			}
			
			return response()->json([
				'cad' => [
					'display' => (bool)$ret->status,
					'id' => $ret->id,
					'app' => $ret->app_name,
					'icon' => $ret->app_icon,
					'img' => $ret->bg_img,
					'video' => $ret->video,
					'link' => $link,
					'timer' => $ret->timer,
				]
			]);	
		}

		return response()->json([
			'ret' => false
		]);		
	}
	
	public function getconfigBn($type) {
		$ret = AdDetailBanner::inRandomOrder()->where('type', $type)->where('status',1)->first();
		//var_dump($ret);
		
		if($ret) {
			if($ret->ios_url == null) {
				$link = $ret->web_url;
			} else {
				$link = $ret->ios_url;
			}
			
			return response()->json([
				'bn' => [
					'display' => (bool)$ret->status,
					'id' => $ret->id,
					'img' => $ret->bg_img,
					'link' => $link,
				]
			]);	
		}
		
		return response()->json([
			'ret' => false
		]);		
		
	}
}