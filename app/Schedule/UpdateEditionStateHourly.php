<?php

namespace App\Schedule;

use App\Models\Edition;
use Carbon\Carbon;

class UpdateEditionStateHourly
{
    public function __invoke(): void
    {
        $edition = Edition::current();

        if ($edition) {
            if ($edition->end_at <= Carbon::now()) {
                $edition->state = Edition::STATE_ARCHIVE;
            } else if ($edition->start_at <= Carbon::now()) {
                $edition->state = Edition::STATE_EXECUTION;
            }

            $edition->save();
        }
    }
}
