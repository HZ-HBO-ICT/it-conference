<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SponsorTier extends Model
{
    use HasFactory;

    /**
     * Establishes the connection
     * A sponsor tier has many teams
     *
     * @return HasMany
     */
    public function team(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
