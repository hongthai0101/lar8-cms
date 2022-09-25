<?php

namespace Messi\Base\Http\Controllers\Admin;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Messi\Base\Models\User;
use Illuminate\Http\Request;
use Messi\Base\DataTables\UsersDataTable;
use Messi\Base\Events\UserModified;
use Messi\Base\Forms\UserForm;
use Messi\Base\Http\Controllers\BaseController;
use Messi\Base\Http\Requests\Admin\UserRequest;
use Messi\Base\Repositories\Contracts\RoleRepository;
use Messi\Base\Repositories\Contracts\UserRepository;
use Messi\Base\Supports\Forms\FormBuilder;
use Messi\Base\Traits\ControllerTrait;

class UserController extends BaseController
{
    use ControllerTrait;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->applyMiddleware('User');
        $this->repository = $repository;
    }

    /**
     * @param UsersDataTable $userTable
     * @return mixed
     */
    public function index(UsersDataTable $userTable): mixed
    {
        $this->setTitle(__('User List'));
        $this->setBreadcrumbs([
            [
                'title' => __('User')
            ]
        ]);
        return $userTable->render('core/base::user.index');
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder): string
    {
        $this->setTitle(__('Create user'));
        $this->setBreadcrumbs([
            [
                'title' => __('User'),
                'url' => route('admin.users.index')
            ],
            [
                'title' => __('Create User'),
            ]
        ]);
        return $formBuilder->create(UserForm::class)->renderForm();
    }

    /**
     * @param UserRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(UserRequest $request): Redirector|RedirectResponse
    {
        /** @var User $user */
        $user = $this->repository->create($request->validated());
        event(new UserModified($user, $request->role_id));
        return $this->redirect(route('admin.users.index'));
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

    /**
     * @param int $id
     * @return Factory|View
     */
    public function show(int $id): View|Factory
    {
        $this->setTitle(__('User Information'));
        $this->setBreadcrumbs([
            [
                'title' => __('User'),
                'url' => route('admin.users.index')
            ],
            [
                'title' => __('User Information'),
            ]
        ]);

        /** @var User $item */
        $item = $this->repository->find($id);
        $roleId = optional(optional($item->roles)->first())->id;
        $roleRepo = app(RoleRepository::class);
        $roles = $roleRepo->all(['id', 'name'])->pluck('name', 'id')->toArray();
        $roles =[__('Remove role')] + $roles;
        return view('core/base::user.show', compact('item', 'roleId', 'roles'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function update(int $id, Request $request): Redirector|RedirectResponse
    {
        if ($password = $request->password) {
            $this->repository->update(['password' => $password], $id);
        }elseif ($request->has('role_id')) {
            /** @var User $item */
            $item = $this->repository->find($id);
            event(new UserModified($item, $request->role_id));
        }
        return $this->redirect(route('admin.users.index'));
    }
}
