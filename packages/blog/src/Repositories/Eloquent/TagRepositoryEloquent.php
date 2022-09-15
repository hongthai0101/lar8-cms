<?php
namespace Messi\Blog\Repositories\Eloquent;

use Messi\Base\Repositories\BaseRepository;
use Messi\Blog\Models\Tag;
use Messi\Blog\Repositories\Contracts\TagRepository;

class TagRepositoryEloquent extends BaseRepository implements TagRepository
{
    public function model()
    {
        return Tag::class;
    }
}