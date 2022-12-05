<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $creator_name = "";
    protected $admin_email = "";
    protected $admin_password = "";
    protected $admin_name = "";
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cr_name, $ad_email, $ad_pass, $ad_name)
    {
        $this->creator_name = $cr_name;
        $this->admin_email = $ad_email;
        $this->admin_password = $ad_pass;
        $this->admin_name = $ad_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.newadminadd',[
            'creator_name' => $this->creator_name,
            'admin_email' => $this->admin_email,
            'admin_password' => $this->admin_password,
            'admin_name' => $this->admin_name
        ]);
    }
}
