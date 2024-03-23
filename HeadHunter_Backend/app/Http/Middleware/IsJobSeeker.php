<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsJobSeeker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        
        if (Auth::user() && Auth::user()->jogosultsag == 'álláskereső') {   //átengedi a kérést
            return $next($request);
        }
        //hibaüzenetet küldünk
        return response('Nincs álláskereső hozzáférésed', 401);
    }
}
