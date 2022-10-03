<?php

namespace Messi\Email\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Messi\Base\Http\Controllers\BaseController;
use Messi\Base\Supports\Forms\FormBuilder;
use Messi\Base\Traits\ControllerTrait;
use Messi\Email\DataTables\MailTemplateDataTable;
use Messi\Email\Forms\MailTemplateForm;
use Messi\Email\Http\Requests\Admin\MailTemplateRequest;
use Messi\Email\Repositories\Contracts\MailTemplateRepository;
use Messi\Email\Services\MailService;

class MailTemplateController extends BaseController
{
    use ControllerTrait;

    /**
     * @var MailTemplateRepository
     */
    private MailTemplateRepository $repository;

    /**
     * MailController constructor.
     * @param MailTemplateRepository $repository
     */
    public function __construct(MailTemplateRepository $repository)
    {
        $this->applyMiddleware('MailTemplate');
        $this->repository = $repository;
    }

    /**
     * @param MailTemplateDataTable $table
     * @return mixed
     */
    public function index(MailTemplateDataTable $table): mixed
    {
        $this->setTitle(__('Mail Template List'));
        $this->setBreadcrumbs([
            [
                'title' => __('Mail Template')
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
        $this->setTitle(__('Create Mail Template'));
        $this->setBreadcrumbs([
            [
                'title' => __('Mail Template'),
                'url' => route('admin.mail-templates.index')
            ],
            [
                'title' => __('Create Mail Template'),
            ]
        ]);
        return $formBuilder->create(MailTemplateForm::class)->renderForm();
    }

    /**
     * @param MailTemplateRequest $request
     * @param MailService $service
     * @return RedirectResponse|Redirector
     */
    public function store(MailTemplateRequest $request, MailService $service): Redirector|RedirectResponse
    {
        $result = $service->store($request);
        $route = route('admin.mail-templates.index');
        if (!$result) {
            $this->setType('error')->setMsg(__('Create Mail Template Failure'))->redirect($route);
        }

        return $this->redirect($route);
    }

    /**
     * @param int $id
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit(int $id, FormBuilder $formBuilder): string
    {
        $item = $this->repository->findOrFail($id);
        $this->setTitle(__('Edit Mail Template'));
        $this->setBreadcrumbs([
            [
                'title' => __('Mail Template'),
                'url' => route('admin.mail-templates.index')
            ],
            [
                'title' => __('Edit Template'),
            ]
        ]);
        return $formBuilder->create(MailTemplateForm::class, ['model' => $item, 'method' => 'PUT'])->renderForm();
    }

    /**
     * @param int $id
     * @param MailTemplateRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update(int $id, MailTemplateRequest $request): Redirector|RedirectResponse
    {
        $mailService = new MailService($this->repository);
        $mailService->update($id, $request);
        return $this->redirect(route('admin.mail-templates.index'));
    }

    /**
     * @param int $id
     * @param MailService $service
     * @return Response
     */
    public function destroy(int $id, MailService $service): Response
    {
        $result = $service->destroy($id);
        return response(['status' => $result]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function field(int $id, Request $request): Response
    {
        $data = $request->input('data');
        if (empty($data)) return response(['status' =>  false]);

        $fields = [];
        foreach (array_chunk($data, 3) as $chunk) {
            $fields[] = [
                'field' =>  Arr::get(Arr::first($chunk, function ($item) {
                    return$item['name'] === 'field';
                }), 'value'),
                'model' =>  Arr::get(Arr::first($chunk, function ($item) {
                    return$item['name'] === 'model';
                }), 'value'),
                'fillable' => Arr::get(Arr::first($chunk, function ($item) {
                    return$item['name'] === 'fillable';
                }), 'value'),
            ];
        }
        $this->repository->update(['fields' => $fields], $id);
        return response(['status' =>  true]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function show(int $id, Request $request): Redirector|RedirectResponse
    {
        $service = new MailService($this->repository);
        $service->sendTest($id);
        return $this->redirect(route('admin.mail-templates.index'));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function suggestFillable(Request $request): Response
    {
        $service = new MailService($this->repository);
        $fillable = $service->getSuggestFillable();
        $input = $request->input('q');
        $result = array_filter($fillable, function ($item) use ($input) {
            return stripos($item, $input) !== false;
        });
        $response = [];
        foreach ($result as $item) {
            $response[] = [
                'id' => $item,
                'name' => $item
            ];
        }
        return response(['data' => $response]);
    }
}
