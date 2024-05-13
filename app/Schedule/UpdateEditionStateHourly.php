<?php

namespace App\Schedule;

use App\Models\Edition;
use Illuminate\Support\Carbon;

class UpdateEditionStateHourly extends UpdateEditionState
{
    public function __invoke(): void
    {
        if ($this->edition->end_at <= Carbon::now()) {
            $this->edition->state = Edition::STATE_ARCHIVE;
        } else if ($this->edition->start_at <= Carbon::now()) {
            $this->edition->state = Edition::STATE_EXECUTION;
        }

        $this->edition->save();
    }
}
