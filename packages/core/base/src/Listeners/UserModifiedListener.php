<?php

namespace Messi\Base\Listeners;

use Messi\Base\Events\UserModified;
use Messi\Base\Repositories\Contracts\RoleRepository;
use Yajra\Acl\Models\Role;

class UserModifiedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserModified  $event
     * @return void
     */
    public function handle(UserModified $event)
    {
        $user = $event->user;
        $roleId = $event->roleId;
        if ($roleId) {
            $user->syncRoles($roleId);
            /** @var RoleRepository $roleRepo */
            $roleRepo = app(RoleRepository::class);
            /** @var Role $role */
            $role = $roleRepo->find($roleId);
            $permissions = $role->permissions()->pluck('permission_id')->toArray();
            $user->syncPermissions($permissions);
        }else {
            $user->syncRoles(null);
            $user->syncPermissions([]);
        }
    }
}
