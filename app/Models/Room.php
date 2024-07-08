<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['max_participants', 'name'];

    /**
     * Establishes a relationship between the room and
     * the presentations that will take place in it
     *
     * @return HasMany
     */
    public function presentations() : HasMany
    {
        return $this->hasMany(Presentation::class);
    }

    /**
     * Establishes a relationship between the room and
     * the default presentations that will take place in it
     *
     * @return HasMany
     */
    public function defaultPresentations() : HasMany
    {
        return $this->hasMany(DefaultPresentation::class);
    }
}
