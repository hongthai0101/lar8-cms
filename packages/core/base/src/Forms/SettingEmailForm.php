<?php

namespace Messi\Base\Forms;

use Messi\Base\Http\Requests\Admin\SettingRequest;
use Messi\Base\Models\Setting;
use Messi\Base\Supports\Forms\FormAbstract;

class SettingEmailForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new Setting())
            ->setMethod('PUT')
            ->setCancelUrl(route('admin.settings.email'))
            ->setFormOption('url', route('admin.settings.update'))
            ->setValidatorClass(SettingRequest::class)
            ->add('__mail_sender_name__', 'text', [
                'label'      => __('Sender name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Sender name')
                ],
                'value' => setting('__mail_sender_name__')
            ])
            ->add('__mail_sender_email__', 'email', [
                'label'      => __('Sender email'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Sender email')
                ],
                'value' => setting('__mail_sender_email__')
            ]);
    }
}
