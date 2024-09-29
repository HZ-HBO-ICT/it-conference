<?php

namespace App\Listeners;

use App\Events\CompanyRolesNotified;
use App\Mail\CompanyUpdatedMailable;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandleCompanyRolesNotified
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
    public function handle(CompanyRolesNotified $event): void
    {
        if (!$event->company->is_approved) {
            return;
        }

        $users = collect();
        if ($event->receiver == 'crew') {
            $users = User::role(['event organizer', 'assistant organizer'])->get();
        } else if ($event->receiver == 'representative') {
            $users->push($event->company->representative);
        }

        // Send emails to the users
        foreach ($users as $user) {
            Mail::to($user->email)->send(new CompanyUpdatedMailable($user, $event->company));
        }
    }
}
