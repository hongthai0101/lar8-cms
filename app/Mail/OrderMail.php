<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Messi\Email\Services\TemplateMailable;

/**
 * Class OrderMail.
 *
 * @package App\Mail
 */
class OrderMail extends TemplateMailable
{
   use Queueable, SerializesModels;
}
