<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOrHeadhunter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && (Auth::user()->jogosultsag == 'admin' || Auth::user()->jogosultsag == 'fejvadász')) {   //átengedi a kérést
            return $next($request);
        }
        //hibaüzenetet küldünk
        return response('Nincs sem fejvadász, sem adminisztrátori hozzáférésed', 401);
    }
}
