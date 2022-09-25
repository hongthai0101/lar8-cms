<?php

namespace Messi\Base\Supports\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class OnOffField extends FormField
{

    /**
     * {@inheritDoc}
     */
    protected function getTemplate(): string
    {
        return 'core/base::forms.fields.on-off';
    }
}
