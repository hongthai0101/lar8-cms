<?php

namespace Messi\Email\Exceptions;

use Illuminate\Contracts\Mail\Mailable;

class MissingMailTemplate extends \Exception
{
    public static function forMailable(Mailable $mailable): static
    {
        $mailableClass = class_basename($mailable);

        return new static("No mail template exists for mailable `{$mailableClass}`.");
    }
}
