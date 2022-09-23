<?php
namespace Messi\Base\Repositories\Eloquent;

use Messi\Base\Models\User;
use Messi\Base\Repositories\Contracts\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model(): string
    {
        return User::class;
    }
}
