<?php

namespace App\Stats;

use Spatie\Stats\BaseStats;

class BoothsStats extends BaseStats
{
    public function getName() : string{
        return 'booths';
    }
}
