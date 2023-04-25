<?php

namespace App\Http\Middleware;

use App\Models\ab_articlecategory;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ShareDataWithViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $query=ab_articlecategory::query()->select('ab_name')->orderBy('ab_name')->get();
        view()->share('kategorien', $query);
        return $next($request);
    }
}
