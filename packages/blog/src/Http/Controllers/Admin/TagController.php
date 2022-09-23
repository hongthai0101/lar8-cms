<?php

namespace Messi\Blog\Http\Controllers\Admin;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Messi\Base\Http\Controllers\BaseController;
use Messi\Base\Supports\Forms\FormBuilder;
use Messi\Base\Traits\ControllerTrait;
use Messi\Blog\DataTables\TagDataTable;
use Messi\Blog\Forms\TagForm;
use Messi\Blog\Http\Requests\Admin\TagRequest;
use Messi\Blog\Repositories\Contracts\TagRepository;

class TagController extends BaseController
{
    use ControllerTrait;

    /**
     * @var TagRepository
     */
    private TagRepository $repository;

    /**
     * TagController constructor.
     * @param TagRepository $repository
     */
    public function __construct(TagRepository $repository)
    {
        $this->applyMiddleware('Blog');
        $this->repository = $repository;
    }

    /**
     * @param TagDataTable $table
     * @return mixed
     */
    public function index(TagDataTable $table)
    {
        $this->setTitle(__('Tag List'));
        $this->setBreadcrumbs([
            [
                'title' => __('Tag')
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
        $this->setTitle(__('Create new tag'));
        $this->setBreadcrumbs([
            [
                'title' => __('Tag'),
                'url' => route('admin.tags.index')
            ],
            [
                'title' => __('Create Tag'),
            ]
        ]);
        return $formBuilder->create(TagForm::class)->renderForm();
    }

    /**
     * @param TagRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(TagRequest $request)
    {
        $this->repository->create($request->validated());
        return $this->redirect(route('admin.tags.index'));
    }

    /**
     * @param int $id
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit(int $id, FormBuilder $formBuilder): string
    {
        $item = $this->repository->findOrFail($id);
        $this->setTitle(__('Edit tag'));
        $this->setBreadcrumbs([
            [
                'title' => __('Post'),
                'url' => route('admin.tags.index')
            ],
            [
                'title' => __('Edit Tag'),
            ]
        ]);
        return $formBuilder->create(TagForm::class, ['model' => $item, 'method' => 'PUT'])->renderForm();
    }

    /**
     * @param $id
     * @param TagRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update($id, TagRequest $request)
    {
        $this->repository->update($request->validated(), $id);
        return $this->redirect(route('admin.tags.index'));
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
