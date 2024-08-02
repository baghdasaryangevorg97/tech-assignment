<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ReportRepositoryInterface;
use App\Repositories\ReportRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
