<?php

namespace Messi\Blog\Forms;

use Messi\Base\Supports\Forms\FormAbstract;
use Messi\Base\Types\MasterData;
use Messi\Blog\Http\Requests\Admin\TagRequest;
use Messi\Blog\Models\Tag;

class TagForm extends FormAbstract
{
    /**
     * @return mixed|void
     */
    public function buildForm()
    {
        $url = $this->model ? route('admin.tags.update', $this->model->id) : route('admin.tags.store');
        $statuses = MasterData::statuses();
        $this
            ->setupModel(new Tag())
            ->setValidatorClass(TagRequest::class)
            ->setFormOption('url', $url)
            ->setCancelUrl(route('admin.tags.index'))
            ->withCustomFields()
            ->add('title', 'text', [
                'label'      => __('Title'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Title')
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
            ->add('status', 'customSelect', [
                'label'      => __('Status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => $statuses,
            ])
            ->setBreakFieldPoint('status');
    }
}
