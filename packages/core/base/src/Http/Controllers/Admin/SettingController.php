<?php

namespace Messi\Base\Http\Controllers\Admin;


use Illuminate\Http\RedirectResponse;
use Messi\Base\DataTables\SettingDataTable;
use Messi\Base\Forms\SettingEmailForm;
use Messi\Base\Forms\SettingGeneralForm;
use Messi\Base\Forms\SettingMediaForm;
use Messi\Base\Http\Controllers\BaseController;
use Messi\Base\Http\Requests\Admin\SettingRequest;
use Messi\Base\Supports\Forms\FormBuilder;
use Messi\Base\Traits\ControllerTrait;
use Setting;

class SettingController extends BaseController
{
    use ControllerTrait;

    /**
     * SettingController constructor.
     */
    public function __construct()
    {
        $this->applyMiddleware('Setting');
    }

    /**
     * @param SettingDataTable $userTable
     * @return mixed
     */
    public function index(SettingDataTable $userTable): mixed
    {
        setting('__admin_logo__', 1);
        $this->setTitle(__('Setting List'));
        $this->setBreadcrumbs([
            [
                'title' => __('Setting')
            ]
        ]);
        return $userTable->render('core/base::datatable.index');
    }

    /**
     * @param SettingRequest $request
     * @return RedirectResponse
     */
    public function update(SettingRequest $request): RedirectResponse
    {
        $settings = $request->except(['_method', '_token']);
        foreach ($settings as $key => $val) {
            Setting::set($key, $val);
        }
        return redirect()->back()->with([
            'type' => 'success',
            'msg' => __('Action successfully')
        ]);
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function general(FormBuilder $formBuilder): string
    {
        $this->setTitle(__('Setting General'));
        $this->setBreadcrumbs([
            [
                'title' => __('Setting'),
                'url' => route('admin.settings.general')
            ],
            [
                'title' => __('Setting General'),
            ]
        ]);
        return $formBuilder->create(SettingGeneralForm::class)->renderForm();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function email(FormBuilder $formBuilder): string
    {
        $this->setTitle(__('Setting Email'));
        $this->setBreadcrumbs([
            [
                'title' => __('Setting'),
                'url' => route('admin.settings.email')
            ],
            [
                'title' => __('Setting Email'),
            ]
        ]);
        return $formBuilder->create(SettingEmailForm::class)->renderForm();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function media(FormBuilder $formBuilder): string
    {
        $this->setTitle(__('Setting Media'));
        $this->setBreadcrumbs([
            [
                'title' => __('Setting'),
                'url' => route('admin.settings.media')
            ],
            [
                'title' => __('Setting Media'),
            ]
        ]);
        return $formBuilder->create(SettingMediaForm::class)->renderForm();
    }
}
