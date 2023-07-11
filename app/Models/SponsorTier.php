<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SponsorTier extends Model
{
    use HasFactory;

    /**
     * All the teams that have this sponsorship tier
     * @return HasMany
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
