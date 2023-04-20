<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        if (Cookie::has('remember_token')) {
            $token = Cookie::get('remember_token');
            $user = User::whereHas('tokens', function ($query) use ($token) {
                $query->where('name', 'remember_me')->where('remember_token', hash('sha256', $token));
            })->first();

            if ($user) {
                Auth::login($user, true);
            }
        }

        if(env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
