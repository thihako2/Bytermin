<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                //Log::debug("check before if" . auth()->user()->is_admin == true);
                //if (auth()->user()->is_admin) {
                //    Log::debug(auth()->user()->is_admin == true);
                //    return   redirect(RouteServiceProvider::AdminHome);
                //} else {
                return redirect(RouteServiceProvider::HOME);
                //}
            }
        }

        return $next($request);
    }
}
