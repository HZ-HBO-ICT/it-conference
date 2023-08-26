<?php

namespace App\Listeners;

use App\Events\PresentationApproved;
use App\Models\User;
use App\Notifications\NotifyPresentationApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandlePresentationApproved
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
    public function handle(PresentationApproved $event): void
    {
        $presentation = $event->presentation;

        $user = User::find($presentation->mainSpeaker()->user->id);
        $user->speaker->is_approved = 1;
        $user->assignRole('speaker');
        $user->speaker->save();

        foreach (User::emailRecipients()->get() as $user) {
            $user->notify(new NotifyPresentationApproved($presentation));
        }
    }
}
