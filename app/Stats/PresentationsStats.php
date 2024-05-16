<?php

namespace App\Stats;

use Spatie\Stats\BaseStats;

class PresentationsStats extends BaseStats
{
    /**
     * @return string presentations
     */
    public function getName() : string
    {
        return 'presentations';
    }
}
