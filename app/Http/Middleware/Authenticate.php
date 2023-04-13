<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        if($request->session()->has('abalo_user')) {
            return $next($request);
        }else{
            return redirect()->guest('/isloggedin');
        }
    }

}
