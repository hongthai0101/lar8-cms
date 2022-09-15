<?php

namespace Messi\Base\Listeners;

use Messi\Base\Models\User;
use Messi\Base\Events\RoleModified;

class RoleModifiedListener
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
     * @param  RoleModified  $event
     * @return void
     */
    public function handle(RoleModified $event)
    {
        $role = $event->role;
        $permissions = $role->permissions()->pluck('permission_id')->toArray();
        if ( !empty($permissions) ) {
            foreach ($role->users()->get() as $user) {
                /** @var User $user */
                $user->syncPermissions($permissions);
            }
        }
    }
}
