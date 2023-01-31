<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProfileUpdateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->name != null && Auth::user()->email != null && Auth::user()->phone != null && Auth::user()->dob != null && Auth::user()->gender != null) {
            return $next($request);
        } else {
            return redirect()->route('profile', app()->getLocale())->with("msg", "You must provide enough personal information before using the system");
        }
    }
}
