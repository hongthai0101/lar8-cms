<?php

namespace Messi\Base\Providers;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Messi\Base\View\Components\Alert;
use Messi\Base\View\Components\MetaSeo;
use Messi\Base\View\Components\Portlet;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('portlet', Portlet::class);
        Blade::component('alert', Alert::class);
        Blade::component('meta-seo', MetaSeo::class);
    }
}