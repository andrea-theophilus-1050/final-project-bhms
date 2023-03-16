<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Services;

class ServicesPriceChangedFirst
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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 'landlords') {
                $services = Services::where('user_id', $user->id)->where('changed', 0)->get();
                if (count($services) > 0) {
                    return redirect()->route('services.index')->with('error', 'You must change the price of the service before using the system');
                } else {
                    return $next($request);
                }
            }
        }
    }
}
