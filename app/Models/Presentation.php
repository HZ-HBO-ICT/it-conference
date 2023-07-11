<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Presentation extends Model
{
    use HasFactory;

    /**
     * The room that the presentation is in
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * The timeslot that the presentation is in
     * @return BelongsTo
     */
    public function timeslot(): BelongsTo
    {
        return $this->belongsTo(Timeslot::class);
    }

    /**
     * All participants that signed up for the presentation
     * @return BelongsToMany
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'participants', 'presentation_id', 'user_id');
    }

    /**
     * All speakers for the presentation
     * @return HasMany
     */
    public function speakers(): HasMany
    {
        return $this->hasMany(Speaker::class);
    }
}
