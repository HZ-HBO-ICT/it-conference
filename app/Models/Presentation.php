<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Presentation extends Model
{
    use HasFactory;

    /**
     * Establishes a relationship between the presentation
     * and its difficulty
     * @return BelongsTo
     */
    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }

    /**
     * Establishes a relationship between the presentation and
     * the timeslot it's assigned to
     * @return BelongsTo
     */
    public function timeslot(): BelongsTo
    {
        return $this->belongsTo(Timeslot::class);
    }

    /**
     * Establishes a relationship between the presentation and
     * the room it's assigned to
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Establishes a relationship between the presentations and the company
     * NOTE: Not all the presentations have a company (there are independent speakers)
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Hides a many-to-many relationship with users
     * and implements relationship with linking table UserPresentation
     * @return HasMany
     */
    public function userPresentations(): HasMany
    {
        return $this->hasMany(UserPresentation::class);
    }

    /**
     * Retrieves all users that have enrolled in the presentation as participants
     * @return Attribute
     */
    public function participants(): Attribute
    {
        return Attribute::make(
            get: fn() => User::whereHas('userPresentations', function ($query) {
                $query->where('presentation_id', $this->id)
                    ->where('role', 'participant');
            })->get(),
        );
    }

    /**
     * Retrieves all the speakers of the presentation
     * @return Attribute
     */
    public function speakers(): Attribute
    {
        return Attribute::make(
            get: fn() => User::whereHas('userPresentations', function ($query) {
                $query->where('presentation_id', $this->id)
                    ->where('role', 'speaker');
            })->get(),
        );
    }
}
