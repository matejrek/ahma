<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Session;
use App;
use Config;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        else{ 
            App::setLocale(Config::get('app.fallback_locale'));
        }
        return $next($request);
    }
}
