<?php
namespace Messi\Base\Traits;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Yajra\Acl\Models\Permission;

trait ControllerTrait
{
    /**
     * Apply middleware to __construct method
     *
     * @param null $resource
     */
    protected function applyMiddleware($resource = null)
    {
        if (!$resource) return ;

        if (app()->isLocal()) {
            $this->createPermission($resource);
        }

        $permissions = $this->getPermissions($resource);

        if (empty($permissions)) return ;

        foreach ($permissions as $permission) {
            $this->middleware([Arr::get($permission, 'permission')])->only(Arr::get($permission, 'only'));
        }
    }

    /**
     * Create permission data if not exists
     * @param $resource
     */
    protected function createPermission($resource)
    {
        $hasPermission = Permission::where('resource', $resource)->count();
        if ($hasPermission > 0) return ;

        Permission::createResource($resource);
    }

    /**
     * @param $resource
     * @return array
     */
    protected function getPermissions($resource): array
    {
        $group = Str::title($resource);
        $slug = Str::slug($group);

        return [
            [
                'permission' => 'permission:viewAny-'.$slug,
                'only' => ['index']
            ],
            [
                'permission' => 'permission:view-'.$slug,
                'only' => ['show']
            ],
            [
                'permission' => 'permission:create-'.$slug,
                'only' => ['create', 'store']
            ],
            [
                'permission' => 'permission:update-'.$slug,
                'only' => ['edit', 'update']
            ],
            [
                'permission' => 'permission:delete-'.$slug,
                'only' => ['destroy', 'update']
            ]
        ];
    }
}
