<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

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
            if (App::isLocale('en')) {
                return redirect()->route('profile')->with("msg", "You must provide enough personal information before using the system");
            } else if (App::getLocale() == 'fra') {
                return redirect()->route('profile')->with("msg", "Vous devez fournir suffisamment d'informations personnelles avant d'utiliser le système");
            } else if (App::isLocale('vie')) {
                return redirect()->route('profile')->with("msg", "Bạn phải cung cấp đủ thông tin cá nhân trước khi sử dụng hệ thống");
            } else {
                return redirect()->route('profile')->with("msg", "您必须在使用系统前提供足够的个人信息");
            }
        }
    }
}
