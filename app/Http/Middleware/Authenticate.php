<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->route()->getName() === 'haslogin'||$request->route()->getName() === 'login') {
            // Skip this middleware for the haslogin route
            return $next($request);
        }
        if($request->session()->has('abalo_user')) {
            return $next($request);
        }else{
            return redirect()->route('haslogin');
        }
    }

}
