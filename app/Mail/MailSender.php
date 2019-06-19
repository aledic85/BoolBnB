<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $content;
    public $name;
    public $lastname;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($name, $lastname, $email, $title, $content)
     {
         $this->name = $name;
         $this->lastname = $lastname;
         $this->email = $email;
         $this->title = $title;
         $this->content = $content;

     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.test-mail');
    }
}
