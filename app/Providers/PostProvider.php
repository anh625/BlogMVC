<?php

namespace App\Providers;

use App\Repositories\Contracts\IPostRepository;
use App\Repositories\ICategoryRepository;
use App\Repositories\Impl\PostRepository;
use App\Services\Contracts\IPostService;
use App\Services\Impl\PostService;
use Illuminate\Support\ServiceProvider;

class PostProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(IPostRepository::class, PostRepository::class);
        $this->app->bind(IPostService::class, PostService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
