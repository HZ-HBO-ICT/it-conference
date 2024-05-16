<?php

namespace App\Stats;

use Spatie\Stats\BaseStats;

class BoothsStats extends BaseStats
{
    /**
     * @return string the booth
     */
    public function getName() : string{
        return 'booths';
    }
}
