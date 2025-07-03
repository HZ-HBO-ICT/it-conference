<?php

namespace App\Models;

use App\Observers\FeedbackObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([FeedbackObserver::class])]
/**
 *
 *
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string $content
 * @property int|null $reported_by_id
 * @property int $is_archived
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $reportedBy
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereIsArchived($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereReportedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'title', 'content', 'reported_by_id'];

    public static $rules = [
        'type' => 'required|in:organization,website',
        'title' => 'required|max:255|string',
        'content' => 'required|max:1500|string',
    ];

    /**
     * Establishes connection to the user who gave the feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by_id');
    }
}
