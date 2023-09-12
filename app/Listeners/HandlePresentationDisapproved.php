<?php

namespace App\Listeners;

use App\Events\PresentationDisapproved;
use App\Mail\PresentationDisapprovedMailable;
use App\Notifications\NotifyPresentationDisapproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandlePresentationDisapproved
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
    public function handle(PresentationDisapproved $event): void
    {
        $presentation = $event->presentation;

        $presentation->speakers()->delete();
        $presentation->delete();
    }
}
