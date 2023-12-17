<?php

namespace App\Providers;

use App\Support\Elexio\Elexio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('elexio', fn () => new Elexio());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventAccessingMissingAttributes(! app()->isProduction());
        Model::preventLazyLoading(! app()->isProduction());

        Model::unguard();
    }
}
