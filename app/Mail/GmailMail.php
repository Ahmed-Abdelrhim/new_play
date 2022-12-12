<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GmailMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $code;
    //public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $msg, $code)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): GmailMail
    {
        return $this->from('laravel.team@mail.com')
            ->subject($this->msg)
            ->markdown('emails.shipped-order');
    }
}
// uxnsrtnhpyyhuzpn 587
