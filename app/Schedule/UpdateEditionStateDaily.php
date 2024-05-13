<?php

namespace App\Schedule;

use App\Models\Edition;
use Illuminate\Support\Carbon;

class UpdateEditionStateDaily extends UpdateEditionState
{
    public function __invoke(): void
    {
        if ($this->edition->getEvent('Presentation request')->end_at <= Carbon::today()) {
            $this->edition->state = Edition::STATE_ENROLLMENT;
        } else if ($this->edition->getEvent('Company registration')->start_at <= Carbon::today()) {
            $this->edition->state = Edition::STATE_ANNOUNCE;
        }

        $this->edition->save();
    }
}
