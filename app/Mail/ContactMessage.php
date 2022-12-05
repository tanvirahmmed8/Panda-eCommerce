<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $info = "";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($information)
    {
        $this->info = $information;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contact message')->view('email.contactmessage', [
            'info' => $this->info
        ]);
    }
}
