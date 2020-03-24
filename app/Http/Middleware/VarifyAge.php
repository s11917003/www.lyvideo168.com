<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Cookie;

class VarifyAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {	
	    
	    $value = Cookie::get('agevarify');
		var_dump($value);
		
		return ;
		/*
		if($value) {
	    	return $next($request);
	    	//var_dump($value);
	    	//return ;
		} else {
			return ;
            //return redirect('/warning');
		}
		*/
	    
	    /*
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
        */
    }
}
