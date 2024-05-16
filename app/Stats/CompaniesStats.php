<?php

namespace App\Stats;

use Spatie\Stats\BaseStats;

class CompaniesStats extends BaseStats
{
    /**
     * @return string companies
     */
    public function getName() : string{
        return 'companies';
    }
}
