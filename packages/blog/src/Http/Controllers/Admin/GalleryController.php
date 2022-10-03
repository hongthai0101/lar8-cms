<?php

namespace Messi\Blog\Http\Controllers\Admin;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Messi\Base\Http\Controllers\BaseController;
use Messi\Base\Supports\Forms\FormBuilder;
use Messi\Base\Traits\ControllerTrait;
use Messi\Blog\DataTables\GalleryDataTable;
use Messi\Blog\Forms\GalleryForm;
use Messi\Blog\Http\Requests\Admin\GalleryRequest;
use Messi\Blog\Repositories\Contracts\GalleryRepository;

class GalleryController extends BaseController
{
    use ControllerTrait;

    /**
     * @var GalleryRepository
     */
    private GalleryRepository $repository;

    /**
     * GalleryController constructor.
     * @param GalleryRepository $repository
     */
    public function __construct(GalleryRepository $repository)
    {
        $this->applyMiddleware('Blog');
        $this->repository = $repository;
    }

    /**
     * @param GalleryDataTable $table
     * @return mixed
     */
    public function index(GalleryDataTable $table): mixed
    {
        $this->setTitle(__('Gallery List'));
        $this->setBreadcrumbs([
            [
                'title' => __('Gallery')
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
        $this->setTitle(__('Create gallery'));
        $this->setBreadcrumbs([
            [
                'title' => __('Gallery'),
                'url' => route('admin.galleries.index')
            ],
            [
                'title' => __('Create gallery'),
            ]
        ]);
        return $formBuilder->create(GalleryForm::class)->renderForm();
    }

    /**
     * @param GalleryRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(GalleryRequest $request): Redirector|RedirectResponse
    {
        $data = array_merge($request->validated(), ['values' => $request->values]);
        $this->repository->create($data);
        return $this->redirect(route('admin.galleries.index'));
    }

    /**
     * @param int $id
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit(int $id, FormBuilder $formBuilder): string
    {
        $item = $this->repository->findOrFail($id);
        $this->setTitle(__('Edit Gallery'));
        $this->setBreadcrumbs([
            [
                'title' => __('Gallery'),
                'url' => route('admin.galleries.index')
            ],
            [
                'title' => __('Edit Gallery'),
            ]
        ]);
        return $formBuilder->create(GalleryForm::class, ['model' => $item, 'method' => 'PUT'])->renderForm();
    }

    /**
     * @param int $id
     * @param GalleryRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update(int $id, GalleryRequest $request): Redirector|RedirectResponse
    {
        $data = array_merge($request->validated(), ['values' => $request->values]);
        $this->repository->update($data, $id);
        return $this->redirect(route('admin.galleries.index'));
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
