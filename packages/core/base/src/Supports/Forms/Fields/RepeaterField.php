<?php

namespace Messi\Base\Supports\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\SelectType;

class RepeaterField extends SelectType
{

    /**
     * {@inheritDoc}
     */
    protected function getTemplate()
    {
        return 'core/base::forms.fields.repeater';
    }
}
