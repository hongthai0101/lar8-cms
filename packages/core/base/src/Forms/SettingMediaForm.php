<?php

namespace Messi\Base\Forms;

use Messi\Base\Http\Requests\Admin\SettingRequest;
use Messi\Base\Models\Setting;
use Messi\Base\Supports\Forms\Fields\MediaImageField;
use Messi\Base\Supports\Forms\Fields\OnOffField;
use Messi\Base\Supports\Forms\FormAbstract;

class SettingMediaForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new Setting())
            ->setMethod('PUT')
            ->setCancelUrl(route('admin.settings.media'))
            ->setFormOption('url', route('admin.settings.update'))
            ->addCustomField('mediaImage', MediaImageField::class)
            ->addCustomField('onOff', OnOffField::class)
            ->setValidatorClass(SettingRequest::class)
            ->add('__filesystem_default__', 'select', [
                 'label'      => __('Filesystem Storage'),
                 'label_attr' => ['class' => 'control-label required'],
                 'choices'    => [
                     'public' => __('Local'),
                     's3' => __('S3')
                 ],
                'selected' => setting('__filesystem_default__')
             ])
            ->add('__s3_id__', 'text', [
                'label'      => __('AWS_ACCESS_KEY_ID'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => __('AWS_ACCESS_KEY_ID')
                ],
                'value' => setting('__s3_id__')
            ])
            ->add('__s3_secret__', 'text', [
                'label'      => __('AWS_SECRET_ACCESS_KEY'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => __('AWS_SECRET_ACCESS_KEY')
                ],
                'value' => setting('__s3_secret__')
            ])
            ->add('__s3_region__', 'text', [
                'label'      => __('AWS_DEFAULT_REGION'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => __('AWS_DEFAULT_REGION')
                ],
                'value' => setting('__s3_region__')
            ])
            ->add('__s3_bucket__', 'text', [
                'label'      => __('AWS_BUCKET'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => __('AWS_BUCKET')
                ],
                'value' => setting('__s3_bucket__')
            ])
            ->add('media_watermark_enabled', 'onOff', [
                'label'         => __('Watermark Enable'),
                'label_attr'    => ['class' => 'control-label'],
                'default_value' => false,
                'value'         => setting('media_watermark_enabled')
            ])
            ->add('media_default_placeholder_image', 'mediaImage', [
                'label'      => __('Default Placeholder Image'),
                'label_attr' => ['class' => 'control-label'],
                'value' => setting('media_default_placeholder_image')
            ])
            ->add('media_watermark_source', 'mediaImage', [
                'label'      => __('Watermark Source'),
                'label_attr' => ['class' => 'control-label'],
                'value' => setting('media_watermark_source')
            ])
            ->setBreakFieldPoint('media_default_placeholder_image');
    }
}
