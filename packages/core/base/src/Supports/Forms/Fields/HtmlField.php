<?php

namespace Messi\Base\Supports\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class HtmlField extends FormField
{
    /**
     * {@inheritDoc}
     */
    protected function getDefaults(): array
    {
        return [
            'html'       => '',
            'wrapper'    => false,
            'label_show' => false,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getAllAttributes(): array
    {
        // No input allowed for html fields.
        return [];
    }

    /**
     * {@inheritDoc}
     */
    protected function getTemplate(): string
    {
        return 'core/base::forms.fields.html';
    }
}
