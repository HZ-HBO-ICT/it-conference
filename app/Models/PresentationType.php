<?php

namespace App\Models;

use App\Enums\ApprovalStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PresentationType extends Model
{
    protected $fillable = ['name', 'duration', 'description', 'edition_id'];

    /**
     * Establishes a relationship between PresentationType and Presentation
     * @return HasMany
     */
    public function presentations(): HasMany
    {
        return $this->hasMany(Presentation::class);
    }

    /**
     * Establishes a relationship between PresentationType and Edition
     * @return BelongsTo
     */
    public function edition(): BelongsTo
    {
        return $this->belongsTo(Edition::class);
    }

    public function canBeDeleted(): bool {
        return $this->presentations->count() == 0;
    }

    public function unscheduledPresentationCount(): int {
        return $this->presentations()
            ->whereNull('timeslot_id')
            ->whereNull('room_id')
            ->whereNull('start')
            ->where('approval_status', ApprovalStatus::APPROVED)
            ->count();
    }
}
