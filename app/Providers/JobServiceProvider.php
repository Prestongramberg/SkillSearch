<?php

namespace App\Providers;

use App\Repositories\JobRepository;
use App\Repositories\JobRepositoryInterface;
use App\Services\JobService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class JobServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(JobService::class, function (Application $app) {
            return new JobService();
        });

        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
