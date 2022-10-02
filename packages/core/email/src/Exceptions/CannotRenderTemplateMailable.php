<?php

namespace Messi\Email\Exceptions;

use Exception;
use Messi\Email\Services\TemplateMailable;

class CannotRenderTemplateMailable extends Exception
{
    public static function layoutDoesNotContainABodyPlaceHolder(TemplateMailable $templateMailable): static
    {
        $mailableClass = class_basename($templateMailable);

        return new static("The layout for mailable `{$mailableClass}` does not contain a `{{{ body }}}` placeholder");
    }
}
