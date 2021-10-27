<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;
use Closure;
class Language
{
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('locale')) {
            App::setLocale($request->session()->get('locale'));
        } else {
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}
