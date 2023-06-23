<?php

namespace App\Providers;

use App\Models\Task;
use App\Observers\StoreTaskHistoryObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Task::observe(StoreTaskHistoryObserver::class);
    }
}
