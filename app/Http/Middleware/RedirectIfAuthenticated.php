<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->rol == 'admin'){
                return redirect('/admin');
            } elseif (Auth::user()->rol == 'corredor'){
                return redirect ('/panel_usuario');
            } elseif(Auth::user()->rol == 'club'){
                return redirect('/panel_club');
            }

        }

        return $next($request);
    }
}
