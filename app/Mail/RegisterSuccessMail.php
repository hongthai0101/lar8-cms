<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Messi\Email\Services\TemplateMailable;

/**
 * Class RegisterSuccessMail.
 *
 * @package App\Mail
 */
class RegisterSuccessMail extends TemplateMailable
{
    use Queueable, SerializesModels;

    public mixed $name;
	public mixed $phone;
	
    public function __construct(mixed $name, mixed $phone)
    {
        $this->name = $name;
		$this->phone = $phone;
		
    }
}
