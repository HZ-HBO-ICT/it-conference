<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Laravel\Jetstream\TeamInvitation as TeamInvitationModel;

class CustomCompanyInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The team invitation instance.
     *
     * @var Invitation Invitation
     */
    public $invitation;

    /**
     * Create a new message instance.
     *
     * @param $invitation
     * @return void
     */
    public function __construct(Invitation $invitation)
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
        return $this->markdown(
            'emails.custom-company-invite',
            ['acceptUrl' => URL::signedRoute('registration.page.via.invitation', [
                'invitation' => $this->invitation,
            ])]
        )->subject(__('Team Invitation'));
    }
}
