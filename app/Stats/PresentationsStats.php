<?php

namespace App\Stats;

use Spatie\Stats\BaseStats;

class PresentationsStats extends BaseStats
{
    public function getName() : string{
        return 'presentations';
    }
}
