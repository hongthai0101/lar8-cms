<?php

namespace Messi\Base\Supports;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailAbstract extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param array|object|string $address
     * @param null $name
     * @return Mailable
     */
    public function from($address, $name = null)
    {
        $address = $address ?? setting('__mail_sender_email__', config('mail.from.address'));
        $name = $name ?? setting('__mail_sender_name__', config('mail.from.name'));
        return parent::from($address, $name);
    }
}