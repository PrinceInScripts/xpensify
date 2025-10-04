<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $company;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $company)
    {
        $this->user = $user;
        $this->company = $company;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Registration Successful')
                    ->view('emails.registration_success');
    }
}
