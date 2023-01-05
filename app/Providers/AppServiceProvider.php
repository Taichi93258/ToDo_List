<?php

namespace App\Providers;

use App\Library\Estimation;
use App\Library\GetTags;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('Estimation', Estimation::class);
        app()->bind('GetTags', GetTags::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
