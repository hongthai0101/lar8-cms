<?php
namespace Messi\Blog\Repositories\Eloquent;

use Messi\Base\Repositories\BaseRepository;
use Messi\Blog\Models\Category;
use Messi\Blog\Repositories\Contracts\CategoryRepository;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    public function model()
    {
        return Category::class;
    }
}