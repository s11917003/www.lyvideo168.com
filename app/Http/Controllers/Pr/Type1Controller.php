<?php

namespace App\Http\Controllers\Pr;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Type1Controller extends BaseController
{
	public function view($adid) {
		
		//echo $adid;
		return view('app_rwd.pr.type1');
	}

}
