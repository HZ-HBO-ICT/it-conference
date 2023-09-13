<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Difficulty
 *
 * @property int $id
 * @property string $level
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presentation> $presentations
 * @property-read int|null $presentations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Difficulty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Difficulty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Difficulty query()
 * @method static \Illuminate\Database\Eloquent\Builder|Difficulty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Difficulty whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Difficulty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Difficulty whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Difficulty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Difficulty extends Model
{
    use HasFactory;

    /**
     * All the presentations with that difficulty
     * @return HasMany
     */
    public function presentations() : HasMany
    {
        return $this->hasMany(Presentation::class);
    }
}
