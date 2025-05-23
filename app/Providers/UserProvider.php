<?php

namespace App\Providers;

use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Impl\UserRepository;
use App\Services\Contracts\IAdminService;
use App\Services\Contracts\IAuthService;
use App\Services\Contracts\IUserService;
use App\Services\Impl\AdminService;
use App\Services\Impl\AuthService;
use App\Services\Impl\UserService;
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
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IAdminService::class, AdminService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
