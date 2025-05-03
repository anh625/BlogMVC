<?php

namespace App\Providers;

use App\Repositories\Contracts\ICommentRepository;
use App\Repositories\Impl\CommentRepository;
use App\Services\Contracts\ICommentService;
use App\Services\Impl\CommentService;
use Illuminate\Support\ServiceProvider;

class CommentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ICommentService::class, CommentService::class);
        $this->app->bind(ICommentRepository::class, CommentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
