<?php

namespace Messi\Base\Forms;

use Messi\Base\Http\Requests\Admin\SettingRequest;
use Messi\Base\Models\Setting;
use Messi\Base\Supports\Forms\Fields\HtmlField;
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
            ->setFormOption('url', route('admin.settings.update'))
            ->setValidatorClass(SettingRequest::class)
            ->addCustomField('html', HtmlField::class)
            ->add('rowOpen1', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('__mail_from_name__', 'text', [
                'label'      => __('Sender Name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Sender Name')
                ],
                'value' => setting('__mail_from_name__'),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('__mail_from_address__', 'email', [
                'label'      => __('Sender Email'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Sender Email')
                ],
                'value' => setting('__mail_from_address__'),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('rowClose1', 'html', [
                'html' => '</div>',
            ])
            ->add('rowOpen2', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('__mail_driver__', 'text', [
                'label'      => __('Mail Driver'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Mail Driver')
                ],
                'value' => setting('__mail_driver__'),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('__mail_smtp_host__', 'text', [
                'label'      => __('Mail SMTP Host'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Mail SMTP Host')
                ],
                'value' => setting('__mail_smtp_host__'),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('rowClose2', 'html', [
                'html' => '</div>',
            ])
            ->add('rowOpen3', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('__mail_smtp_port__', 'text', [
                'label'      => __('Mail SMTP Port'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Mail SMTP Port')
                ],
                'value' => setting('__mail_smtp_port__'),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('__mail_smtp_encryption__', 'email', [
                'label'      => __('Mail SMTP Encryption'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Mail SMTP Encryption')
                ],
                'value' => setting('__mail_smtp_encryption__'),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('rowClose3', 'html', [
                'html' => '</div>',
            ])
            ->add('rowOpen4', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('__mail_smtp_username__', 'email', [
                'label'      => __('Mail SMTP Username'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Mail SMTP Username')
                ],
                'value' => setting('__mail_smtp_username__'),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('__mail_smtp_password__', 'email', [
                'label'      => __('Mail SMTP Password'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Mail SMTP Password')
                ],
                'value' => setting('__mail_smtp_password__'),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('rowClose4', 'html', [
                'html' => '</div>',
            ]);
    }
}
