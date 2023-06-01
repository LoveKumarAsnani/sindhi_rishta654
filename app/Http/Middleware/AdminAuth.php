<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Session::flash('message', 'You need to login');
            return Redirect::to("login");
        }
        return $next($request);


        // protected function redirectTo($request)
        // {
        //     if (! $request->expectsJson()) {
        //         return route('login');
        //     }
        // }
    }
}
