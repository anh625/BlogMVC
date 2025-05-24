<?php

namespace App\Providers;

use App\Services\Contracts\IAdminService;
use App\Services\Impl\AdminService;
use Illuminate\Support\ServiceProvider;

class AdminProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
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
