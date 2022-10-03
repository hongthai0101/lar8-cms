<?php

namespace Messi\Base\Forms;

use Messi\Base\Http\Requests\Admin\SettingRequest;
use Messi\Base\Models\Setting;
use Messi\Base\Supports\Forms\Fields\MediaImageField;
use Messi\Base\Supports\Forms\FormAbstract;

class SettingGeneralForm extends FormAbstract
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
            ->addCustomField('mediaImage', MediaImageField::class)
            ->setValidatorClass(SettingRequest::class)
            ->add('__admin_title__', 'text', [
                'label'      => __('Title'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Title')
                ],
                'value' => setting('__admin_title__')
            ])
            ->add('__admin_copyright__', 'text', [
                'label'      => __('Copyright'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Copyright')
                ],
                'value' => setting('__admin_copyright__')
            ])
            ->add('__admin_favicon__', 'mediaImage', [
                'label'      => __('Favicon'),
                'label_attr' => ['class' => 'control-label'],
                'value' => setting('__admin_favicon__')
            ])
            ->add('__admin_logo__', 'mediaImage', [
                'label'      => __('Logo'),
                'label_attr' => ['class' => 'control-label'],
                'value' => setting('__admin_logo__')
            ])
            ->setBreakFieldPoint('__admin_favicon__');
    }
}
