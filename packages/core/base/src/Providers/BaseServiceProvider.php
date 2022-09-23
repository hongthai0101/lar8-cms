<?php

namespace Messi\Base\Providers;

use Exception;
use Illuminate\Routing\Router;
use Messi\Base\Events\RoleModified;
use Messi\Base\Events\UserModified;
use Messi\Base\Http\ViewComposers\SidebarViewComposer;
use Messi\Base\Listeners\RoleModifiedListener;
use Messi\Base\Listeners\UserModifiedListener;
use Messi\Base\Models\User;
use Messi\Base\Supports\Cache;
use Messi\Base\Supports\Setting;
use Messi\Base\Traits\LoadPublishServiceTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Messi\Base\Http\Middleware\JwtMiddleware;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\RefreshToken;
use Yajra\Acl\Middleware\CanAtLeastMiddleware;
use Yajra\Acl\Middleware\PermissionMiddleware;
use Yajra\Acl\Middleware\RoleMiddleware;
use View;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\DataTablesServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    use LoadPublishServiceTrait;

    /**
     * @var bool
     */
    protected bool $defer = true;

    /**
     * @throws Exception | BindingResolutionException
     */
    public function register()
    {
        $this->app->register(RegisterRepositoryServiceProvider::class);
        $this->app->register(ComponentServiceProvider::class);
        $this->app->register(DataTablesServiceProvider::class);

        /**
         * @var Router $router
         */
        $router = $this->app['router'];
        $router->aliasMiddleware('canAtLeast', CanAtLeastMiddleware::class);
        $router->aliasMiddleware('permission', PermissionMiddleware::class);
        $router->aliasMiddleware('role', RoleMiddleware::class);

        // api
        $router->aliasMiddleware('jwt.verify', JwtMiddleware::class);
        $router->aliasMiddleware('jwt.refresh', RefreshToken::class);

        $this->app->singleton('setting', function ($app) {
            $config = [
                'cache_file' => $app->config->get('core.base.base.setting.cache_file', 'settings.json'),
                'db_table'   => 'settings'
            ];
            return new Setting($app['db'], new Cache($config['cache_file']), $config);
        });
    }

    /**
     * @throws Exception
     */
    public function boot()
    {
        $this->setNamespace('core/base')
            ->loadPublishConfigurations(['base'])
            ->publishAssets()
            ->loadPublishViews()
            ->loadMigrations()
            ->publishSeeders()
            ->loadRoutes(['web', 'api']);

        View::composer(
            'core/base::layouts.partials.sidebar', SidebarViewComposer::class
        );

        Event::listen(
            UserModified::class,
            [UserModifiedListener::class, 'handle']
        );

        Event::listen(
            RoleModified::class,
            [RoleModifiedListener::class, 'handle']
        );

        $this->app->booted(function () {
            config()->set(['auth.providers.users.model' => User::class]);
            config()->set(['auth.guards.api.driver' => 'jwt']);

            config()->set(['acl.user' => User::class]);
        });
    }

    /**
     * Which IoC bindings the provider provides.
     *
     * @return array
     */
    public function provides(): array
    {
        return array ('setting');
    }
}
