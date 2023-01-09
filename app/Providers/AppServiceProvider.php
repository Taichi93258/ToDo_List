<?php

namespace App\Providers;

use App\Library\Estimation;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Composer\TagComposer;
use Illuminate\Support\Facades\View;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'todo.*',
            TagComposer::class
        );
    }
}