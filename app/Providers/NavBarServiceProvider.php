<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NavBarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->composeNavbar();
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

    public function composeNavbar()
    {
        view()->composer('layouts.app','App\Http\Composers\NavbarComposer');
    }
}
