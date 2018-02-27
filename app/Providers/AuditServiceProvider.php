<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuditServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('audit', 'App\Entities\Security\Audit');
    }
}
