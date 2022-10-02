<?php

namespace Messi\Email\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
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
        //$ser = new MailService($this->repository);
        //$ser->update($id);

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
        $this->repository->update($request->validated(), $id);
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

    public function show(int $id)
    {
        $mailTemplate = $this->repository->find($id);
        $email = 'thailh.work@gmail.com';
        Mail::to($email)->send(new ($mailTemplate->mailable)('123'));
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

        $this->repository->update(['fields' => $data], $id);
        return response(['status' =>  true]);
    }
}
