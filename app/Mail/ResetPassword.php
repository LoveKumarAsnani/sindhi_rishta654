<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $uniqueId;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct($uniqueId)
    {
        $this->uniqueId = $uniqueId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return $this
    //         ->subject('Reset Password')
    //         ->markdown('emails.resetPassword');
    // }
    public function build()
    {
        return $this->text('emails.resetPassword');
    }
}
