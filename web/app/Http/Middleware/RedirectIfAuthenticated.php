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

            $auth = Auth::user()->roles()->first()->designation;

            switch ($auth) {
                case 'Role_SuperAdmin':
                    return  redirect('/administration');
                    break;
                case 'Role_HopitalAdmin':
                    return  redirect('/hopital');
                    break;
            }
        }

        return $next($request);
    }
}
