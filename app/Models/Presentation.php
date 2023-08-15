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

    protected $fillable = ['name', 'max_participants', 'description', 'type', 'difficulty_id'];

    public static function rules()
    {
        return [
            'name' => 'required',
            'max_participants' => 'required|numeric',
            'description' => 'required',
            'type' => 'required|in:workshop,lecture',
            'difficulty_id' => 'required'
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

    public function mainSpeaker()
    {
        return $this->speakers()->where('is_main_speaker', 1)->first();
    }
}
