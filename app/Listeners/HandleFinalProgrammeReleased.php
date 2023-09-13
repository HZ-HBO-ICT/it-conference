<?php

namespace App\Listeners;

use App\Events\FinalProgrammeReleased;
use App\Models\GlobalEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        GlobalEvent::create([
            'type' => 'App\Events\FinalProgrammeReleased'
        ]);
    }
}
