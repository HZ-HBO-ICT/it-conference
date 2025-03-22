<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string $start
 * @property string $end
 * @property string $type Can contain only opening or closing
 * @property int|null $room_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Room|null $room
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultPresentation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DefaultPresentation extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'description', 'type', 'start', 'room_id', 'start', 'end'];

    /**
     * Establishes the relationship between default presentation and the room
     *
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Function that retrieves the opening presentation
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public static function opening()
    {
        return self::query()
            ->where('type', '=', 'opening')
            ->first();
    }

    /**
     * Function that retrieves the closing presentation
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public static function closing()
    {
        return self::query()
            ->where('type', '=', 'closing')
            ->first();
    }
}
