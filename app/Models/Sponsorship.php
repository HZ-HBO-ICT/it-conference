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
    public function companies() : HasMany {
        return $this->hasMany(Company::class);
    }
}
