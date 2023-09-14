<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Difficulty
 *
 * @property int $id
 * @property string $level
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Presentation> $presentations
 * @property-read int|null $presentations_count
 * @method static Builder|Difficulty newModelQuery()
 * @method static Builder|Difficulty newQuery()
 * @method static Builder|Difficulty query()
 * @method static Builder|Difficulty whereCreatedAt($value)
 * @method static Builder|Difficulty whereDescription($value)
 * @method static Builder|Difficulty whereId($value)
 * @method static Builder|Difficulty whereLevel($value)
 * @method static Builder|Difficulty whereUpdatedAt($value)
 * @mixin Eloquent
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
