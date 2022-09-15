<?php

namespace Messi\Base\Forms;

use Messi\Base\Http\Requests\Admin\UserRequest;
use Messi\Base\Supports\Forms\FormAbstract;
use Messi\Base\Models\User;
use Yajra\Acl\Models\Role;

class UserForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $roles = Role::all(['id', 'name'])->pluck('name', 'id')->toArray();
        $this
            ->setupModel(new User)
            ->setMethod('POST')
            ->setCancelUrl(route('admin.users.index'))
            ->setFormOption('url', route('admin.users.store'))
            ->setValidatorClass(UserRequest::class)
            ->withCustomFields()
            ->add('rowOpen1', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('name', 'text', [
                'label'      => __('Name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Name')
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('email', 'text', [
                'label'      => __('Email'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Email')
                ],
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
            ->add('password', 'password', [
                'label'      => __('Password'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Password')
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('password_confirmation', 'password', [
                'label'      => __('Password Confirmation'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Password Confirmation')
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('rowClose2', 'html', [
                'html' => '</div>',
            ])
            ->add('role_id', 'customSelect', [
                'label'         => __('Role'),
                'label_attr'    => ['class' => 'control-label'],
                'attr'          => [
                    'class' => 'form-control',
                ],
                'choices'       => ['' => __('Select Role')] + $roles,
                'default_value' => null,
            ])
            ->setBreakFieldPoint('role_id');
    }
}
