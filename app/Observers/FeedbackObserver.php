<?php

namespace App\Observers;

use App\Mail\FeedbackReceivedMailable;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class FeedbackObserver
{
    /**
     * Handle the Feedback "created" event.
     */
    public function created(Feedback $feedback): void
    {
        $crew = User::where('crew_team', $feedback->type)->get();
        foreach ($crew as $user) {
            Mail::to($user->email)->send(new FeedbackReceivedMailable($feedback));
        }
    }
}
