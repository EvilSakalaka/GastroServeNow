<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        //Ha a felhasznalo be van jelentve, es a szerepe benne van a megadott szerepek kozott, akkor tovabbengedi a kérést
        if (auth()->check() && in_array(auth()->user()->role, $roles)){
            return $next($request);
        }
        //Egyebkent visszairanyitja a felhasznalot a fokepernyore
        return redirect('/dashboard')->with('error', "Nincs jogosultsagod az oldal megtekintéséhez.");
    }
}
