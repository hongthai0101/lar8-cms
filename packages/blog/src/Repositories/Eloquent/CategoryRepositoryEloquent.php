<?php
namespace Messi\Blog\Repositories\Eloquent;

use Messi\Base\Repositories\BaseRepository;
use Messi\Blog\Models\Category;
use Messi\Blog\Repositories\Contracts\CategoryRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

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

    /**
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }
}
