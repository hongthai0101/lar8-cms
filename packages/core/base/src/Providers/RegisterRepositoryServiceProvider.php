<?php

namespace Messi\Base\Providers;

use Messi\Base\Repositories\Contracts\MetaBoxRepository;
use Messi\Base\Repositories\Contracts\SlugRepository;
use Messi\Base\Repositories\Contracts\UserRepository;
use Messi\Base\Repositories\Eloquent\MetaBoxRepositoryEloquent;
use Messi\Base\Repositories\Eloquent\SlugRepositoryEloquent;
use Messi\Base\Repositories\Eloquent\UserRepositoryEloquent;
use Messi\Base\Repositories\Contracts\RoleRepository;
use Messi\Base\Repositories\Eloquent\PermissionRepositoryEloquent;
use Messi\Base\Repositories\Contracts\PermissionRepository;
use Messi\Base\Repositories\Eloquent\RoleRepositoryEloquent;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class RegisterRepositoryServiceProvider extends ServiceProvider
{

    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @throws \Exception | BindingResolutionException
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(RoleRepository::class, RoleRepositoryEloquent::class);
        $this->app->bind(PermissionRepository::class, PermissionRepositoryEloquent::class);
        $this->app->bind(MetaBoxRepository::class, MetaBoxRepositoryEloquent::class);
        $this->app->bind(SlugRepository::class, SlugRepositoryEloquent::class);
    }

    /**
     * @throws \Exception
     */
    public function boot()
    {

    }
}
