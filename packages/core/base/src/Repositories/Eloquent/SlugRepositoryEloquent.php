<?php
namespace Messi\Base\Repositories\Eloquent;

use Messi\Base\Repositories\BaseRepository;
use Messi\Base\Models\Slug;
use Messi\Base\Repositories\Contracts\SlugRepository;

class SlugRepositoryEloquent extends BaseRepository implements SlugRepository
{
    public function model(): string
    {
        return Slug::class;
    }
}
