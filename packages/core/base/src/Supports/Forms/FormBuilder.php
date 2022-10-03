<?php

namespace Messi\Base\Supports\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder as BaseFormBuilder;

class FormBuilder extends BaseFormBuilder
{
    /**
     * {@inheritDoc}
     */
    public function create($formClass, array $options = [], array $data = []): Form
    {
        return parent::create($formClass, $options, $data);
    }
}
