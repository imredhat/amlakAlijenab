<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Hekmatinasser\Verta\Verta;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
         // ثبت Verta در container
        // $this->app->bind('verta', function () {
        //     return new Verta();
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
