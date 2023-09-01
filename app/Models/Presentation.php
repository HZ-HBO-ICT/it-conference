<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Presentation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'max_participants', 'description', 'type', 'difficulty_id', 'file_path'];

    public static function rules()
    {
        return [
            'name' => 'required',
            'max_participants' => 'required|numeric',
            'description' => 'required',
            'type' => 'required|in:workshop,lecture',
            'difficulty_id' => 'required',
            'file_path' => 'required'
        ];
    }

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

    /**
     * The difficulty of the presentation
     * @return BelongsTo
     */
    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }

    // TODO: Refactor with accessor to return the actual user
    public function mainSpeaker()
    {
        return $this->speakers()->where('is_main_speaker', 1)->first();
    }

    /**
     * Checks if the main speaker is approved, therefore if the presentation is approved
     * @return Attribute
     */
    public function isApproved(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->mainSpeaker()->is_approved,
        );
    }

    /**
     * Checks if the presentation is scheduled
     * @return Attribute
     */
    public function isScheduled(): Attribute
    {
        return Attribute::make(
            get: fn() => !is_null($this->timeslot) && !is_null($this->room),
        );
    }

    /**
     * The maximum number of participants for the presentation is determined
     * by the smaller value between the room's capacity and the specified
     * maximum participants for the presentation.
     *
     * @return int
     */
    public function maxParticipants(): int
    {
        return $this->room->max_participants < $this->max_participants
            ? $this->room->max_participants
            : $this->max_participants;
    }

    /**
     * Called in order to approve the speakers connected to the presentation
     * @return void
     */
    public function approve()
    {
        foreach ($this->speakers as $speaker) {
            $speaker->approve();
        }
    }
}
