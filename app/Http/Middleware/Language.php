<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Support\Facades\Session;
class Language
{   
    
    protected $language = ['zh'=>1 ,'en'=>2 ,'jp'=>3];
    public function handle($request, Closure $next)
    {

        $lang = $request->lang;
        if($lang && in_array($lang,['zh','en','jp'])){
            \Session::put('locale', $lang);
            App::setLocale($lang);
        }
        else if ($request->session()->get('locale')) {
            App::setLocale($request->session()->get('locale'));
        } else {
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}
