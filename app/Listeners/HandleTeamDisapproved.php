<?php

namespace App\Listeners;

use App\Actions\Jetstream\DeleteTeam;
use App\Events\TeamDisapproved;
use App\Mail\TeamDisapprovedMailable;
use App\Models\Team;
use App\Notifications\NotifyTeamApproved;
use App\Notifications\NotifyTeamDisapproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandleTeamDisapproved
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
    public function handle(TeamDisapproved $event): void
    {
        $team = $event->team;

        $team->owner->notify(new NotifyTeamDisapproved($team));
        $deleteTeam = new DeleteTeam();
        $deleteTeam->delete($team);
    }
}
