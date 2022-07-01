<?php

namespace App\Providers;

use App\ProvidesWords;
use App\UnixWordsProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        $this->app->bind(ProvidesWords::class, UnixWordsProvider::class);
    }
}
