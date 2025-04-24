<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    /**
     * Create a new message instance.
     *
     * @param array<string, string> $data  An associative array with contact form input
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the contact form submission email.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->markdown('emails.contact-form-submission')
            ->subject('New Contact Form Submission - ' . $this->data['subject'])
            ->with(['data' => $this->data]);
    }
}
