<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignupInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public string $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Welcome to [blank]')
            ->view('emails.invite')
            ->with(['url' => $this->url]);
    }
}
