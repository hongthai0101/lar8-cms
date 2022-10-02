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
class SuccessOrderMail extends TemplateMailable
{
    use Queueable, SerializesModels;

    public mixed $full_name;
	public mixed $user_id;
	public mixed $phone;
	public mixed $content;

   public function __construct(mixed $full_name, mixed $user_id, mixed $phone, mixed $content)
   {
        $this->full_name = $full_name;
		$this->user_id = $user_id;
		$this->phone = $phone;
		$this->content = $content;
   }
}
