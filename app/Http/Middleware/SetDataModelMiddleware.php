<?php

namespace App\Http\Middleware;

use App\Models\GeneralInfo;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetDataModelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $village = GeneralInfo::first();
        view()->share('village', $village);
        return $next($request);
    }
}
