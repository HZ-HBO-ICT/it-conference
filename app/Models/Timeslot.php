<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Timeslot extends Model
{
    use HasFactory;

    /**
     * Establishes a relationship between the timeslot and
     * the presentations in it
     * @return HasMany
     */
    public function presentations() : HasMany
    {
        return $this->hasMany(Presentation::class);
    }
}
