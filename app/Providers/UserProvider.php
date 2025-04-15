<?php

namespace App\Providers;

use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Impl\UserRepository;
use App\Services\Contracts\IAuthService;
use App\Services\Impl\AuthService;
use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IAuthService::class, AuthService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
