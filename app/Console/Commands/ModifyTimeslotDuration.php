<?php

namespace App\Console\Commands;

use App\Models\Timeslot;
use Illuminate\Console\Command;

class ModifyTimeslotDuration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:modify-timeslot-duration {currentDuration} {wantedDuration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modifies the duration of a specified type of timeslots';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDuration = $this->argument('currentDuration');
        $wantedDuration = $this->argument('wantedDuration');

        $timeslots = Timeslot::where('duration', $currentDuration);

        if($timeslots->count() == 0)
        {
            $this->error('There are no timeslots with such duration');
            return;
        }

        $timeslots->update(['duration'=>$wantedDuration]);
        $this->info("You successfully updated all timeslots from duration of {$currentDuration} to {$wantedDuration}");
    }
}
