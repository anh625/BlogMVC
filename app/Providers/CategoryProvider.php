<?php

namespace App\Providers;

use App\Repositories\ICategoryRepository;
use App\Repositories\Impl\CategoryRepository;
use App\Services\ICategoryService;
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
