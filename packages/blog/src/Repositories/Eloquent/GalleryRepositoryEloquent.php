<?php
namespace Messi\Blog\Repositories\Eloquent;

use Messi\Base\Repositories\BaseRepository;
use Messi\Blog\Models\Gallery;
use Messi\Blog\Repositories\Contracts\GalleryRepository;

class GalleryRepositoryEloquent extends BaseRepository implements GalleryRepository
{
    public function model()
    {
        return Gallery::class;
    }
}