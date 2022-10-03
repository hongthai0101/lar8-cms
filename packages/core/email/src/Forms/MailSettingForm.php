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
            ->setCancelUrl(route('admin.mail-templates.setting'))
            ->addCustomField('editor', EditorField::class)
            ->add('footer', 'editor', [
                'label'      => __('Footer Template'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'rows'            => 4,
                    'placeholder'     => __('Footer Template')
                ],
            ])
            ->add('header', 'editor', [
                'label'      => __('Header Template'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'rows'            => 4,
                    'placeholder'     => __('Header Template')
                ],
            ]);

    }
}
