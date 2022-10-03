<?php

namespace Messi\Email\Forms;

use Messi\Base\Supports\Forms\Fields\EditorField;
use Messi\Base\Supports\Forms\FormAbstract;
use Messi\Email\Http\Requests\Admin\MailSettingRequest;
use Messi\Email\Models\MailTemplate;

class MailSettingForm extends FormAbstract
{
    /**
     * @return void
     */
    public function buildForm()
    {
        $url = route('admin.mail-setting.update');
        $this
            ->setupModel(new MailTemplate())
            ->setValidatorClass(MailSettingRequest::class)
            ->setFormOption('url', $url)
            ->setCancelUrl(route('admin.mail-setting.index'))
            ->addCustomField('editor', EditorField::class)
            ->add('header', 'editor', [
                'label'      => __('Header Template'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'rows'            => 2,
                    'placeholder'     => __('Header Template')
                ],
                'value' => \File::get(config('core.email.mail-template.setting.header'))
            ])
            ->add('footer', 'editor', [
                'label'      => __('Footer Template'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'rows'            => 2,
                    'placeholder'     => __('Footer Template')
                ],
                'value' => \File::get(config('core.email.mail-template.setting.footer'))
            ]);

    }
}
