<?php

namespace App\Providers;

use App\Contracts\WebsiteRepositoryInterface;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\ServiceProvider;

class WebsiteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WebsiteRepositoryInterface::class, WebsiteRepository::class);
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
