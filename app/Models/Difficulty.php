<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presentation> $presentations
 * @property-read int|null $presentations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Difficulty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Difficulty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Difficulty query()
 * @mixin \Eloquent
 */
class Difficulty extends Model
{
    use HasFactory;

    /**
     * Establishes a relationship between the difficulty level
     * and the presentations that have it
     * @return HasMany
     */
    public function presentations() : HasMany
    {
        return $this->hasMany(Presentation::class);
    }
}
