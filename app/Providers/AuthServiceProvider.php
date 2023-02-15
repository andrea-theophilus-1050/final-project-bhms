<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Auth\Events\Login;
use Laravel\Sanctum\HasApiTokens;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }

    protected $listen = [
        Login::class => [
            SetRememberMeCookie::class,
        ],
    ];
}

class SetRememberMeCookie
{
    public function handle(Login $event)
    {
        if ($event->remember) {
            if ($event->user instanceof HasApiTokens) {
                $token = $event->user->createToken('remember_me')->plainTextToken;
                Cookie::queue('remember_me', $token, 60 * 24 * 30);
            }
        }
    }
}
