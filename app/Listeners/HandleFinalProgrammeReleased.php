<?php

namespace App\Listeners;

use App\Events\FinalProgrammeReleased;
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
        //
    }
}
