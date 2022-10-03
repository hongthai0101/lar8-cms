<?php

namespace Messi\Blog\Providers;


use Exception;
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
    protected bool $defer = true;

    /**
     * @throws Exception
     */
    public function register()
    {
        $this->app->register(RegisterRepositoryServiceProvider::class);
    }

    /**
     * @throws Exception
     */
    public function boot()
    {
        $this->setNamespace('blog')
            ->loadPublishViews()
            ->loadMigrations()
            ->loadRoutes(['web', 'api']);

        View::composer(
            'core/base::layouts.partials.sidebar', SidebarViewComposer::class
        );
    }

    /**
     * Which IoC bindings the provider provides.
     *
     * @return array
     */
    public function provides(): array
    {

    }
}
