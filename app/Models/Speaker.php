<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Speaker
 *
 * @property int $id
 * @property int $user_id
 * @property int $presentation_id
 * @property int $is_main_speaker Since there can be multiple presenters for a single presentation
 * @property int $is_approved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Presentation $presentation
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\SpeakerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker query()
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereIsMainSpeaker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker wherePresentationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereUserId($value)
 * @mixin \Eloquent
 */
class Speaker extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'presentation_id', 'is_main_speaker', 'is_approved'];

    /**
     * The presentation the speaker has
     * @return BelongsTo
     */
    public function presentation(): BelongsTo
    {
        return $this->belongsTo(Presentation::class);
    }

    /**
     * The user that is going to be speaker at the presentation
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Approves the speaker and makes it a global speaker
     * @return void
     */
    public function approve() : void
    {
        $this->is_approved = 1;
        $this->user->assignRole('speaker');
        $this->save();
    }
}
