<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InstituteRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

public $institute = '';
public $code = '';
public $name = '';
/**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $institute, string $code, string $name)
    {
        $this->institute = $institute;
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Registration Confirmation',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
          markdown: 'email.instituteRegistration',
          with: ['institute'=>$this->institute, 'code' => $this->code, 'principal' => $this->name, ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
