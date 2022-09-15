<?php

namespace Messi\Blog\Http\Controllers\Admin;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Messi\Base\Http\Controllers\BaseController;
use Messi\Base\Supports\Forms\FormBuilder;
use Messi\Base\Traits\ControllerTrait;
use Messi\Blog\DataTables\CategoryDataTable;
use Messi\Blog\Forms\CategoryForm;
use Messi\Blog\Http\Requests\Admin\CategoryRequest;
use Messi\Blog\Repositories\Contracts\CategoryRepository;

class CategoryController extends BaseController
{
    use ControllerTrait;

    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->applyMiddleware('Blog');
        $this->repository = $repository;
    }

    /**
     * @param CategoryDataTable $table
     * @return mixed
     */
    public function index(CategoryDataTable $table)
    {
        $this->setTitle(__('Category List'));
        $this->setBreadcrumbs([
            [
                'title' => __('Category')
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
        $this->setTitle(__('Create category'));
        $this->setBreadcrumbs([
            [
                'title' => __('Category'),
                'url' => route('admin.categories.index')
            ],
            [
                'title' => __('Create Category'),
            ]
        ]);
        return $formBuilder->create(CategoryForm::class)->renderForm();
    }

    /**
     * @param CategoryRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->create($request->validated());
        return $this->redirect(route('admin.categories.index'));
    }

    /**
     * @param $id
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder): string
    {
        $item = $this->repository->findOrFail($id);
        $this->setTitle(__('Edit category'));
        $this->setBreadcrumbs([
            [
                'title' => __('Post'),
                'url' => route('admin.categories.index')
            ],
            [
                'title' => __('Edit Category'),
            ]
        ]);
        return $formBuilder->create(CategoryForm::class, ['model' => $item, 'method' => 'PUT'])->renderForm();
    }

    /**
     * @param $id
     * @param CategoryRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update($id, CategoryRequest $request)
    {
        $this->repository->update($request->validated(), $id);
        return $this->redirect(route('admin.categories.index'));
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return response(['status' => true]);
    }
}
