<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * This model is a linking table between the user and the presentation.
 *
 * The model also has a role attribute showing the "relationship" between the user
 * and presentation (speaker/participant)
 * The model is not to be used directly. Use either Presentation or User model
 *
 * @property int $id
 * @property int $user_id
 * @property int $presentation_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Presentation $presentation
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPresentation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPresentation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPresentation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPresentation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPresentation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPresentation wherePresentationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPresentation whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPresentation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPresentation whereUserId($value)
 * @mixin \Eloquent
 */
class UserPresentation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'presentation_id', 'role'];

    /**
     * Establishes relationship between users and this model (linking table) to presentations
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Establishes relationship between presentations and this model (linking table) to users
     * @return BelongsTo
     */
    public function presentation(): BelongsTo
    {
        return $this->belongsTo(Presentation::class);
    }
}
