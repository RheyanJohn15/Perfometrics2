<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMessageUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $fname;
    public $mname;
    public $lname;
    public $suffix;
    public $username;
    public $password;
    public $type;
    public $email;
    public function __construct($fname, $mname, $lname, $suffix, $username, $password, $type, $email)
    {
        $this->fname= $fname;
        $this->mname= $mname;
        $this->lname = $lname;
        $this->suffix = $suffix;
        $this->username = $username;
        $this->password = $password;
        $this->type= $type;
        $this->email= $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'From Perfometrics Admin',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'administrator.sendMessageUser',
            with: [
                'fname' => $this->fname,
                'mname' => $this->mname,
                'lname' => $this->lname,
                'suffix' => $this->suffix,
                'username' => $this->username,
                'password' => $this->password,
                'type' => $this->type,
                'email' => $this->email,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
