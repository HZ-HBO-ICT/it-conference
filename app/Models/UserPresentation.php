<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * This model is a linking table between the user and the presentation.
 * The model also has a role attribute showing the "relationship" between the user
 * and presentation (speaker/participant)
 * The model is not to be used directly. Use either Presentation or User model
 */
class UserPresentation extends Model
{
    use HasFactory;

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
