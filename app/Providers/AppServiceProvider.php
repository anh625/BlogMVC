<?php

namespace App\Providers;

use App\Services\Impl\PostService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $postService = app(PostService::class);
            $view->with('allCategories', $postService->getAllCategories());
        });
    }
}
