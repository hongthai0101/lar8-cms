<?php
namespace Messi\Blog\Repositories\Eloquent;

use Messi\Base\Repositories\BaseRepository;
use Messi\Blog\Models\Post;
use Messi\Blog\Repositories\Contracts\PostRepository;

class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    public function model()
    {
        return Post::class;
    }
}