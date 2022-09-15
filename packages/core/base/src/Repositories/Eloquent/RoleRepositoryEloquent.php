<?php
namespace Messi\Base\Repositories\Eloquent;

use Messi\Base\Repositories\Contracts\RoleRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Yajra\Acl\Models\Role;

class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    public function model()
    {
        return Role::class;
    }
}