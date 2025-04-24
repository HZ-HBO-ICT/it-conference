<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The form data.
     * 
     * @var array<string, string>
     */
    public array $data;

    /**
     * Create a new message instance.
     * 
     * @param array<string, string> $data The validated form data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return void
     */
    public function build(): void
    {
        $this->markdown('emails.contact-form-submission')
             ->subject('New Contact Form Submission - ' . $this->data['subject'])
             ->with(['data' => $this->data]);
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): \Illuminate\Mail\Mailables\Content
    {
        return new \Illuminate\Mail\Mailables\Content(
            markdown: 'emails.contact-form-submission',
            with: ['data' => $this->data],
        );
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): \Illuminate\Mail\Mailables\Envelope
    {
        return new \Illuminate\Mail\Mailables\Envelope(
            subject: 'New Contact Form Submission - ' . $this->data['subject']
        );
    }
}
