<?php

namespace Messi\Blog\Providers;


use Illuminate\Support\ServiceProvider;
use Messi\Base\Traits\LoadPublishServiceTrait;
use Messi\Blog\Http\ViewComposers\SidebarViewComposer;
use View;

class BlogServiceProvider extends ServiceProvider
{
    use LoadPublishServiceTrait;

    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @throws \Exception | BindingResolutionException
     */
    public function register()
    {
        $this->app->register(RegisterRepositoryServiceProvider::class);
    }

    /**
     * @throws \Exception
     */
    public function boot()
    {
        $this->setNamespace('blog')
            ->loadPublishViews()
            ->loadMigrations()
            ->loadRoutes();

        View::composer(
            'core/base::layouts.partials.sidebar', SidebarViewComposer::class
        );
    }

    /**
     * Which IoC bindings the provider provides.
     *
     * @return array
     */
    public function provides()
    {

    }
}
