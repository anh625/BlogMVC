<?php

namespace App\Providers;

use App\Repositories\Contracts\IContactRepository;
use App\Repositories\Impl\ContactRepository;
use App\Services\Contracts\IContactService;
use App\Services\Impl\ContactService;
use Illuminate\Support\ServiceProvider;

class ContactProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(IContactRepository::class, ContactRepository::class);
        $this->app->bind(IContactService::class,ContactService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
