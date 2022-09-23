<?php

namespace Messi\Blog\Http\Controllers\Admin;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Messi\Base\Http\Controllers\BaseController;
use Messi\Blog\Services\Admin\PostService;
use Messi\Base\Supports\Forms\FormBuilder;
use Messi\Base\Traits\ControllerTrait;
use Messi\Blog\DataTables\PostDataTable;
use Messi\Blog\Forms\PostForm;
use Messi\Blog\Http\Requests\Admin\PostRequest;
use Messi\Blog\Repositories\Contracts\PostRepository;

class PostController extends BaseController
{
    use ControllerTrait;

    /**
     * @var PostRepository
     */
    private PostRepository $repository;

    /**
     * PostController constructor.
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->applyMiddleware('Blog');
        $this->repository = $repository;
    }

    /**
     * @param PostDataTable $table
     * @return mixed
     */
    public function index(PostDataTable $table)
    {
        $this->setTitle(__('Post List'));
        $this->setBreadcrumbs([
            [
                'title' => __('Post')
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
        $this->setTitle(__('Create post'));
        $this->setBreadcrumbs([
            [
                'title' => __('Post'),
                'url' => route('admin.posts.index')
            ],
            [
                'title' => __('Create Blog'),
            ]
        ]);
        return $formBuilder->create(PostForm::class)->renderForm();
    }

    /**
     * @param PostRequest $request
     * @param PostService $service
     * @return RedirectResponse|Redirector
     */
    public function store(PostRequest $request, PostService $service)
    {
        $service->store($request, $this->repository);
        return $this->redirect(route('admin.posts.index'));
    }

    /**
     * @param int $id
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit(int $id, FormBuilder $formBuilder): string
    {
        $item = $this->repository->findOrFail($id);
        $this->setTitle(__('Edit post'));
        $this->setBreadcrumbs([
            [
                'title' => __('Post'),
                'url' => route('admin.posts.index')
            ],
            [
                'title' => __('Edit Post'),
            ]
        ]);
        return $formBuilder->create(PostForm::class, ['model' => $item, 'method' => 'PUT'])->renderForm();
    }

    /**
     * @param $id
     * @param PostRequest $request
     * @param PostService $service
     * @return RedirectResponse|Redirector
     */
    public function update($id, PostRequest $request, PostService $service)
    {
        $service->update($id, $request, $this->repository);
        return $this->redirect(route('admin.posts.index'));
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
