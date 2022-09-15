<?php
namespace Messi\Base\Repositories\Eloquent;

use Messi\Base\Repositories\BaseRepository;
use Messi\Base\Models\MetaBox;
use Messi\Base\Repositories\Contracts\MetaBoxRepository;

class MetaBoxRepositoryEloquent extends BaseRepository implements MetaBoxRepository
{
    public function model()
    {
        return MetaBox::class;
    }
}