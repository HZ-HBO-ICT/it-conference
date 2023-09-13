<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GlobalEvent
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalEvent whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalEvent whereUpdatedAt($value)
 * @mixin \Eloquent
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
