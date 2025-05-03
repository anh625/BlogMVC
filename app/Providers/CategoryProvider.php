<?php

namespace App\Providers;

use App\Repositories\Contracts\ICategoryRepository;
use App\Repositories\Impl\CategoryRepository;
use App\Services\Contracts\ICategoryService;
use App\Services\Impl\CategoryService;
use Illuminate\Support\ServiceProvider;

class CategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
