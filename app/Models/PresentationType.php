<?php

namespace App\Models;

use App\Enums\ApprovalStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $colour
 * @property int $duration
 * @property int $edition_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Edition $edition
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presentation> $presentations
 * @property-read int|null $presentations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType whereColour($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType whereEditionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PresentationType extends Model
{
    protected $fillable = ['name', 'duration', 'description', 'colour', 'edition_id'];

    /**
     * Establishes a relationship between PresentationType and Presentation
     * @return HasMany<Presentation, $this>
     */
    public function presentations(): HasMany
    {
        return $this->hasMany(Presentation::class);
    }

    /**
     * Establishes a relationship between PresentationType and Edition
     * @return BelongsTo<Edition, $this>
     */
    public function edition(): BelongsTo
    {
        return $this->belongsTo(Edition::class);
    }

    /**
     * Establishes
     * @return bool
     */
    public function canBeSafelyDeleted(): bool
    {
        return $this->presentations->count() == 0;
    }

    /**
     * Determines if there are any scheduled presentations that can be affected if
     * the model is updated; if there aren't then it can be safely updated
     * @return bool
     */
    public function canBeSafelyUpdated(): bool
    {
        return $this->presentations()
            ->whereNotNull('timeslot_id')
            ->whereNotNull('room_id')
            ->whereNotNull('start')
            ->where('approval_status', ApprovalStatus::APPROVED)
            ->count() == 0;
    }

    /**
     * Determines the numbered of presentations that are still to be scheduled
     * @return int
     */
    public function unscheduledPresentationCount(): int
    {
        return $this->presentations()
            ->whereNull('timeslot_id')
            ->whereNull('room_id')
            ->whereNull('start')
            ->where('approval_status', ApprovalStatus::APPROVED)
            ->count();
    }
}
