<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\GlobalEvent
 *
 * @property int $id
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|GlobalEvent newModelQuery()
 * @method static Builder|GlobalEvent newQuery()
 * @method static Builder|GlobalEvent query()
 * @method static Builder|GlobalEvent whereCreatedAt($value)
 * @method static Builder|GlobalEvent whereId($value)
 * @method static Builder|GlobalEvent whereType($value)
 * @method static Builder|GlobalEvent whereUpdatedAt($value)
 * @mixin Eloquent
 */
class GlobalEvent extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public static function isFinalProgrammeReleased()
    {
        return GlobalEvent::where('type', 'App\Events\FinalProgrammeReleased')->exists();
    }
}
