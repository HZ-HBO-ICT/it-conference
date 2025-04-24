<?php

namespace App\Mail;

use App\Models\Company;
use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class CompanyRepInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The team invitation instance.
     *
     * @var Invitation
     */
    public Invitation $invitation;

    /**
     * The company instance.
     *
     * @var Company|null
     */
    public ?Company $company;

    /**
     * Create a new message instance.
     *
     * @param Invitation $invitation
     * @return void
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
        $this->company = $invitation->company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invite-company-rep')
            ->subject('Invitation to Join ' . $this->company?->name . ' as a Representative');
    }
}
