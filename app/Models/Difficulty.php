<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Difficulty extends Model
{
    use HasFactory;

    /**
     * Establishes a relationship between the difficulty level
     * and the presentations that have it
     * @return HasMany
     */
    public function presentations() : HasMany {
        return $this->hasMany(Presentation::class);
    }
}
