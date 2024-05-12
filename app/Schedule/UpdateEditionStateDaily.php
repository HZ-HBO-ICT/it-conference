<?php

namespace App\Schedule;

use App\Models\Edition;
use Carbon\Carbon;

class UpdateEditionStateDaily
{
    public function __invoke(): void
    {
        $edition = Edition::current();

        if ($edition) {
            if ($edition->getEvent('Presentation request')->end_at <= Carbon::today()) {
                $edition->state = Edition::STATE_ENROLLMENT;
            } else if ($edition->getEvent('Company registration')->start_at <= Carbon::today()) {
                $edition->state = Edition::STATE_ANNOUNCE;
            }

            $edition->save();
        }
    }
}
