<?php

namespace App\Listeners;

use App\Events\PresentationRolesNotified;
use App\Mail\PresentationUpdatedMailable;
use App\Models\Presentation;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandlePresentationRolesNotified
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PresentationRolesNotified $event): void
    {
        if (!$event->presentation->is_approved) {
            return;
        }

        $users = collect();
        if ($event->receiver == 'crew') {
            $users = User::role(['event organizer', 'speakers supervisor', 'assistant organizer'])->get();
        } else if ($event->receiver == 'speaker') {
            $users = $event->presentation->speakers;
        }

        // Send emails to the users
        foreach ($users as $user) {
            Mail::to($user->email)->send(new $event->emailTemplate($user, $event->presentation));
        }
    }
}
