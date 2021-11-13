<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {   
        Session::put('language',$request->segment(1));
        App::setLocale($request->segment(1));
        $request->route()->forgetParameter('lang');
        return $next($request);
    }
}