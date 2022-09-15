<?php

namespace Messi\Base\Forms;

use Messi\Base\Http\Requests\Admin\RoleRequest;
use Messi\Base\Supports\Forms\FormAbstract;
use Yajra\Acl\Models\Role;

class RoleForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new Role)
            ->setMethod('POST')
            ->setCancelUrl(route('admin.roles.index'))
            ->setFormOption('url', route('admin.roles.store'))
            ->setValidatorClass(RoleRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label'      => __('Name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder' => __('Name'),
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-12',
                ],
            ])
            ->add('slug', 'text', [
                'label'      => __('Slug'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Slug')
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-12',
                ],
            ])
            ->add('description', 'text', [
                'label'      => __('Description'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Description')
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-12',
                ],
            ]);
    }
}
