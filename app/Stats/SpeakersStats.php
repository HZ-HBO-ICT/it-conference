<?php

namespace App\Stats;

use Spatie\Stats\BaseStats;

class SpeakersStats extends BaseStats
{
    /**
     * @return string speakers
     */
    public function getName() : string{
        return 'speakers';
    }
}
