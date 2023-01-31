<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InstituteActivationMail extends Mailable
{
    use Queueable, SerializesModels;


  public $institute = '';
  public $code = '';
  public $name = '';
  public $type = '';
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(string $institute, string $code, string $name, string $type = 'active')
  {
    $this->institute = $institute;
    $this->code = $code;
    $this->name = $name;
    $this->type = $type;
  }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
      if ($this->type == 'active') {
        return new Envelope(
          subject: 'Institute Activation Mail',
        );
      }else{
        return new Envelope(
          subject: 'Institute Deactivation Mail',
        );
      }
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
      if ($this->type == 'active'){
        return new Content(
            markdown: 'email.instituteActivation',
            with: ['institute'=>$this->institute, 'code' => $this->code, 'principal' => $this->name, ]
        );
      }else{
        return new Content(
            markdown: 'email.instituteDeactivation',
            with: ['institute'=>$this->institute, 'code' => $this->code, 'principal' => $this->name, ]
        );
      }
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
