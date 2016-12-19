<?php

namespace App\Http\Middleware;
use Illuminate\Cookie;
use Closure;
use Illuminate\Session;

class CheckCity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        return $next($request);


    }
}
