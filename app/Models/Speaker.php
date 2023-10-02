<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\SpeakerFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Speaker
 *
 * @property int $id
 * @property int $user_id
 * @property int $presentation_id
 * @property int $is_main_speaker Since there can be multiple presenters for a single presentation
 * @property int $is_approved
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Presentation $presentation
 * @property-read User $user
 * @method static SpeakerFactory factory($count = null, $state = [])
 * @method static Builder|Speaker newModelQuery()
 * @method static Builder|Speaker newQuery()
 * @method static Builder|Speaker query()
 * @method static Builder|Speaker whereCreatedAt($value)
 * @method static Builder|Speaker whereId($value)
 * @method static Builder|Speaker whereIsApproved($value)
 * @method static Builder|Speaker whereIsMainSpeaker($value)
 * @method static Builder|Speaker wherePresentationId($value)
 * @method static Builder|Speaker whereUpdatedAt($value)
 * @method static Builder|Speaker whereUserId($value)
 * @mixin Eloquent
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
        return $this->belongsTo(Presentation::class, 'presentation_id', 'id');
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
