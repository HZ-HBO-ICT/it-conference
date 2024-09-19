<?php

namespace App\Listeners;

use App\Events\FinalProgrammeReleased;
use App\Mail\FinalProgrammeReleasedMailable;
use App\Models\Edition;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandleFinalProgrammeReleased
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
    public function handle(FinalProgrammeReleased $event): void
    {
        $current = Edition::current();
        $current->state = Edition::STATE_ENROLLMENT;
        $current->save();

        foreach (User::sendEmailPreference()->get() as $user) {
            if ($user->ticket && !$user->is_crew) {
                Mail::to($user->email)->send(new FinalProgrammeReleasedMailable($user));
            }
        }
    }
}
