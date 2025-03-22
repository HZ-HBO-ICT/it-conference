<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property int $event_id
 * @property int $edition_id
 * @property Carbon|null $start_at
 * @property Carbon|null $end_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Edition $edition
 * @property-read \App\Models\Event $event
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EditionEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EditionEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EditionEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EditionEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EditionEvent whereEditionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EditionEvent whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EditionEvent whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EditionEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EditionEvent whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EditionEvent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EditionEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'edition_id',
        'start_at',
        'end_at'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    /**
     * Returns basic validation rules for EditionEvent
     * @return string[]
     */
    public static function rules(): array
    {
        return [
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date',
        ];
    }

    /**
     * Establishes a relationship between EditionEvent and Edition models
     * @return BelongsTo
     */
    public function edition(): BelongsTo
    {
        return $this->belongsTo(Edition::class);
    }

    /**
     * Establishes a relationship between EditionEvent and Event models
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
