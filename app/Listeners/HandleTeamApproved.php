<?php

namespace App\Listeners;

use App\Events\TeamApproved;
use App\Mail\TeamApprovedMailable;
use App\Models\User;
use App\Notifications\NotifyTeamApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandleTeamApproved
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TeamApproved $event): void
    {
        $team = $event->team;

        foreach (User::role('participant')->get() as $user)
        {
            $user->notify(new NotifyTeamApproved($team));
        }

        $team->is_approved = true;
        $team->owner->assignRole('company representative');
        $team->save();
    }
}
