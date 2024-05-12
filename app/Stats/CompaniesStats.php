<?php

namespace App\Stats;

use Spatie\Stats\BaseStats;

class CompaniesStats extends BaseStats
{
    public function getName() : string{
        return 'companies';
    }
}
