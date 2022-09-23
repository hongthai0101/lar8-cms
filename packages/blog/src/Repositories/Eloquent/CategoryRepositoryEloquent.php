<?php
namespace Messi\Blog\Repositories\Eloquent;

use Messi\Base\Repositories\BaseRepository;
use Messi\Blog\Models\Category;
use Messi\Blog\Repositories\Contracts\CategoryRepository;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'title' => 'like',
        'description' => 'like',
        'status' => '=',
        'is_featured' => '='
    ];

    public function model(): string
    {
        return Category::class;
    }
}
