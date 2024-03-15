<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Laravel\Jetstream\TeamInvitation;

class InviteCompany extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The team invitation instance.
     *
     * @var TeamInvitation
     */
    public $invitation;

    /**
     * Create a new message instance.
     *
     * @param TeamInvitation $invitation
     * @return void
     */
    public function __construct(TeamInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invite-company-rep', ['acceptUrl' => URL::signedRoute('company-rep.invitation', [
            'invitation' => $this->invitation,
        ])])->subject(__('Participation in the IT Conference'));
    }
}
