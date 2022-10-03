<?php

namespace Messi\Email\Forms;

use Messi\Base\Supports\Forms\Fields\AutocompleteField;
use Messi\Base\Supports\Forms\Fields\CustomSelectField;
use Messi\Base\Supports\Forms\Fields\EditorField;
use Messi\Base\Supports\Forms\Fields\HtmlField;
use Messi\Base\Supports\Forms\Fields\OnOffField;
use Messi\Base\Supports\Forms\FormAbstract;
use Messi\Base\Types\MasterData;
use Messi\Email\Http\Requests\Admin\MailTemplateRequest;
use Messi\Email\Models\MailTemplate;

class MailTemplateForm extends FormAbstract
{
    /**
     * @return void
     */
    public function buildForm()
    {
        $url = route('admin.mail-templates.store');
        $item = $this->model;
        $statuses = MasterData::statuses();
        $replaces = [];
        if ($item) {
            foreach (($item->mailable)::getVariables() as $replace) {
                $replaces[$replace] = $replace;
            }
            $url = route('admin.mail-templates.update', $item->id);
        }
        $this
            ->setupModel(new MailTemplate())
            ->setValidatorClass(MailTemplateRequest::class)
            ->setCancelUrl(route('admin.mail-templates.index'))
            ->addCustomField('customSelect', CustomSelectField::class)
            ->addCustomField('onOff', OnOffField::class)
            ->addCustomField('editor', EditorField::class)
            ->addCustomField('autocomplete', AutocompleteField::class)
            ->add('name', 'text', [
                'label'      => __('Name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Name')
                ],
            ])
            ->add('description', 'textarea', [
                'label'      => __('Description'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'rows'         => 4,
                    'placeholder'  => __('Description')
                ],
            ])
            ->add('subject', 'text', [
                'label'      => __('Subject'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Subject')
                ],
            ])
            ->add('field_replace_to_content', 'autocomplete', [
                'label'      => __('Field Replace To Content'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'id'    => 'field_replace_to_content_select2',
                    'data-url' => route('admin.mail-templates.suggest-fillable'),
                    'multiple' => true,
                    'selected'   => 'title'
                ],
                'choices'    => $replaces,
                'selected'   => array_keys($replaces)
            ])
            ->add('text_template', 'textarea', [
                'label'      => __('Text Template'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'rows'         => 3,
                    'placeholder'  => __('Text Template')
                ],
            ]);
        if ($item) {
            $this
                ->addCustomField('html', HtmlField::class)
                ->add('replaces', 'html', [
                    'html' => view('core/email::replace', compact('replaces')),
                ]);
        }
        $this->add('html_template', 'editor', [
            'label'      => __('Html Template'),
            'label_attr' => ['class' => 'control-label'],
            'attr'       => [
                'rows'            => 4,
                'placeholder'     => __('Html Template')
            ],
        ])
            ->add('status', 'customSelect', [
                'label'      => __('Status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => $statuses,
            ])
            ->add('is_header', 'onOff', [
                'label'         => __('Is Header'),
                'label_attr'    => ['class' => 'control-label'],
                'default_value' => true,
            ])
            ->add('is_footer', 'onOff', [
                'label'         => __('Is Footer'),
                'label_attr'    => ['class' => 'control-label'],
                'default_value' => true,
            ])
            ->setBreakFieldPoint('status')
            ->setFormOption('url', $url);
        if ($item) {
            $models = [];
            foreach (config('core.email.mail-template.model') as $model) {
                $fillable = [];
                if (class_exists($model)) {
                    $fillable = app($model)->getFillable();
                }
                $arr = explode('\\', $model);
                $models[] = [
                    'model' => $model,
                    'label' => $arr[count($arr) - 1],
                    'fillable' => $fillable
                ];
            }

            $fieldUrl = route('admin.mail-templates.field', $item->id);
            $fields = $item->fields;

            $this
                ->add('advance', 'html', [
                    'html' => view('core/email::filed', compact(
                        'replaces', 'models', 'fieldUrl', 'fields'
                    )),
                ]);
        }
    }
}
