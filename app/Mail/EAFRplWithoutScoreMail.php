<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EAFRplWithoutScoreMail extends Mailable {
  use Queueable, SerializesModels;

  public $url = '127.0.0.1:8000';
  public $institute = '';
  public $principal = '';

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(string $url, string $institute, string $principal) {
    $this->url = $url;
    $this->institute = $institute;
    $this->principal = $principal;
  }

  /**
   * Get the message envelope.
   *
   * @return \Illuminate\Mail\Mailables\Envelope
   */
  public function envelope() {
    return new Envelope(
      subject: 'EAF Submission Confirmation',
    );
  }

  /**
   * Get the message content definition.
   *
   * @return \Illuminate\Mail\Mailables\Content
   */
  public function content() {
    return new Content(
      markdown: 'email.eaf-rpl-without-score-mail',
      with: ['url' => $this->url, 'institute' => $this->institute, 'principal' => $this->principal,]
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array
   */
  public function attachments() {
    return [];
  }
}
