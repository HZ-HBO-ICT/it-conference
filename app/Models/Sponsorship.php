<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sponsorship extends Model
{
    use HasFactory;

    /**
     * Establishes the relationship between a sponsorship level
     * and all the companies that have this sponsorship tier
     * @return HasMany
     */
    public function companies() : HasMany
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Checks if there are any spots left for the specific sponsorship tier
     * @return bool
     */
    public function areMoreSponsorsAllowed()
    {
        return $this->companies()->where('is_sponsorship_approved', '=', 1)
                ->count() < $this->max_sponsors;
    }

    /**
     * Calculates the number of left spots for the specific sponsorship tier
     * @return mixed
     */
    public function leftSpots()
    {
        return $this->max_sponsors - $this->companies()->where('is_sponsorship_approved', '=', 1)
                ->count();
    }

    /**
     * Scope a query to only include companies that require approval
     *
     * @param $query
     * @return mixed
     */
    public function scopeAwaitingApproval($query): mixed
    {
        return $query->join('companies', 'companies.sponsorship_id', '=', 'sponsorships.id')
            ->where('companies.is_sponsorship_approved', '=', 0);
    }
}