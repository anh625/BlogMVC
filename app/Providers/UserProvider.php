<?php

namespace App\Providers;

use App\Repositories\Impl\UserRepository;
use App\Repositories\IUserRepository;
use App\Services\Impl\UserService;
use App\Services\IUserService;
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
        $this->app->bind(IUserService::class, UserService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
