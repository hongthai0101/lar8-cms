<?php

namespace Messi\Email\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Messi\Base\Http\Controllers\BaseController;
use Messi\Base\Supports\Forms\FormBuilder;
use Messi\Base\Traits\ControllerTrait;
use Messi\Email\Forms\MailSettingForm;
use Messi\Email\Http\Requests\Admin\MailSettingRequest;
use Messi\Email\Services\MailSettingService;

class MailSettingController extends BaseController
{
    use ControllerTrait;
    /**
     * MailSettingController constructor.
     */
    public function __construct()
    {
        $this->applyMiddleware('MailTemplate');
    }

    /**
     * @param FormBuilder $formBuilder
     * @return mixed
     */
    public function index(FormBuilder $formBuilder): mixed
    {
        $this->setTitle(__('Mail Setting'));
        $this->setBreadcrumbs([
            [
                'title' => __('Mail Setting'),
                'url' => route('admin.mail-setting.index')
            ],
            [
                'title' => __('Mail Setting'),
            ]
        ]);
        return $formBuilder->create(MailSettingForm::class)->renderForm();
    }

    /**
     * @param MailSettingRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update(MailSettingRequest $request): Redirector|RedirectResponse
    {
        $service = new MailSettingService();
        $service->update($request);
        return $this->redirect(route('admin.mail-setting.index'));
    }
}
