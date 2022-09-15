<?php

namespace Messi\Blog\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Messi\Blog\Repositories\Contracts\CategoryRepository;
use Messi\Blog\Repositories\Contracts\GalleryRepository;
use Messi\Blog\Repositories\Contracts\PostRepository;
use Messi\Blog\Repositories\Contracts\TagRepository;
use Messi\Blog\Repositories\Eloquent\CategoryRepositoryEloquent;
use Messi\Blog\Repositories\Eloquent\GalleryRepositoryEloquent;
use Messi\Blog\Repositories\Eloquent\PostRepositoryEloquent;
use Messi\Blog\Repositories\Eloquent\TagRepositoryEloquent;

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

    }

    /**
     * @throws \Exception
     */
    public function boot()
    {
        $this->app->bind(PostRepository::class, PostRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(TagRepository::class, TagRepositoryEloquent::class);
        $this->app->bind(GalleryRepository::class, GalleryRepositoryEloquent::class);
    }
}
