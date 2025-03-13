<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DefaultPresentation> $defaultPresentations
 * @property-read int|null $default_presentations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presentation> $presentations
 * @property-read int|null $presentations_count
 * @method static \Database\Factories\RoomFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Room query()
 * @mixin \Eloquent
 */
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
