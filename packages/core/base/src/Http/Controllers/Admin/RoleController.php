<?php

namespace Messi\Base\Http\Controllers\Admin;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Messi\Base\DataTables\RoleDataTable;
use Messi\Base\Events\RoleModified;
use Messi\Base\Forms\RoleForm;
use Messi\Base\Http\Controllers\BaseController;
use Messi\Base\Http\Requests\Admin\RoleRequest;
use Messi\Base\Repositories\Contracts\PermissionRepository;
use Messi\Base\Repositories\Contracts\RoleRepository;
use Messi\Base\Supports\Forms\FormBuilder;
use Messi\Base\Traits\ControllerTrait;
use Yajra\Acl\Models\Role;

class RoleController extends BaseController
{
    use ControllerTrait;

    /**
     * @var RoleRepository
     */
    private RoleRepository $repository;

    /**
     * UserController constructor.
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->applyMiddleware('Role');
        $this->repository = $repository;
    }

    /**
     * @param RoleDataTable $table
     * @return mixed
     */
    public function index(RoleDataTable $table): mixed
    {
        $this->setTitle(__('Role List'));
        $this->setBreadcrumbs([
            [
                'title' => __('Role')
            ]
        ]);
        return $table->render('core/base::datatable.index');
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder): string
    {
        $this->setTitle(__('Create role'));
        $this->setBreadcrumbs([
            [
                'title' => __('Role'),
                'url' => route('admin.roles.index')
            ],
            [
                'title' => __('Create Role'),
            ]
        ]);
        return $formBuilder->create(RoleForm::class)->renderForm();
    }

    /**
     * @param RoleRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(RoleRequest $request): Redirector|RedirectResponse
    {
        $this->repository->create($request->validated());
        return $this->redirect(route('admin.roles.index'));
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function edit(int $id): View|Factory
    {
        /** @var Role $role */
        $role = $this->repository->find($id);
        $this->setTitle(__('Update role ') . $role->name);
        $this->setBreadcrumbs([
            [
                'title' => __('Role'),
                'url' => route('admin.roles.index')
            ],
            [
                'title' => __('Update Role'),
            ]
        ]);

        /** @var PermissionRepository $permissionRepo */
        $permissionRepo = app(PermissionRepository::class);
        /** @var Collection $data */
        $data = $permissionRepo->all(['id', 'name', 'resource']);
        $resources = $data->unique('resource')->pluck('resource')->toArray();
        $permissions = [];
        foreach ($resources as $resource) {
            if ( !array_key_exists($resource, $permissions) ) {
                $permissions[$resource] = $data->filter(function ($item) use ($resource){
                    return $item->resource == $resource;
                })->pluck('name', 'id')->toArray();
            }
        }
        $currentPermissions = $role->permissions()->pluck('permission_id')->toArray();
        return view('core/base::role.grant-permission', compact('permissions', 'role', 'currentPermissions'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function update(int $id, Request $request): Redirector|RedirectResponse
    {
        /** @var Role $role */
        $role = $this->repository->find($id);
        $permissions = $request->permissions;
        $role->syncPermissions($permissions);
        event( new RoleModified($role));
        return $this->redirect(route('admin.roles.index'));
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function show(int $id): View|Factory
    {
        /** @var Role $role */
        $role = $this->repository->find($id);
        $this->setTitle(__($role->name . ' Information'));
        $this->setBreadcrumbs([
            [
                'title' => __('Role'),
                'url' => route('admin.roles.index')
            ],
            [
                'title' => __('Information Role'),
            ]
        ]);

        /** @var PermissionRepository $permissionRepo */
        $permissionRepo = app(PermissionRepository::class);
        /** @var Collection $data */
        $currentPermissions = $role->permissions()->pluck('permission_id')->toArray();
        $data = $permissionRepo->findWhereIn('id', $currentPermissions);
        $resources = $data->unique('resource')->pluck('resource')->toArray();
        $permissions = [];
        foreach ($resources as $resource) {
            if ( !array_key_exists($resource, $permissions) ) {
                $permissions[$resource] = $data->filter(function ($item) use ($resource){
                    return $item->resource == $resource;
                })->pluck('name', 'id')->toArray();
            }
        }

        $users = $role->users()->get(['name', 'email']);
        return view('core/base::role.show', compact('permissions', 'role', 'users'));
    }

    /**
     * @param int $id
     * @return ResponseFactory|Response
     */
    public function destroy(int $id): Response|ResponseFactory
    {
        $this->repository->delete($id);
        return response(['status' => true]);
    }
}
