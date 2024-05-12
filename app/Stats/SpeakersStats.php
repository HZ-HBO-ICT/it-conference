<?php

namespace App\Stats;

use Spatie\Stats\BaseStats;

class SpeakersStats extends BaseStats
{
    public function getName() : string{
        return 'speakers';
    }
}
