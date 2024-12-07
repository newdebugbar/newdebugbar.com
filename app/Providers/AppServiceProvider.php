<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        if (class_exists('\Laravel\Telescope\TelescopeServiceProvider') && $this->app->environment('local')) {
            $this->app->register('\Laravel\Telescope\TelescopeServiceProvider');
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    public function boot() : void
    {
        Model::shouldBeStrict(! app()->isProduction());

        Model::unguard();
    }
}
