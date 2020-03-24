<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Lib\Utils;


class AuthAgeController extends Controller {
	public function warning() {
		$device = Utils::chkdevice();
		return  view('app_rwd.index.warning',[
			'device' => $device,
		]);
	}
}