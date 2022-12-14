<?php

namespace Messi\Base\Supports\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\SelectType;

class AutocompleteField extends SelectType
{

    /**
     * {@inheritDoc}
     */
    protected function getTemplate(): string
    {
        return 'core/base::forms.fields.autocomplete';
    }
}
