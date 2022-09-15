<?php
namespace Messi\Base\Repositories\Eloquent;

use Messi\Base\Repositories\Contracts\PermissionRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Yajra\Acl\Models\Permission;

class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    public function model()
    {
        return Permission::class;
    }
}