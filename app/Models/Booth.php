<?php

namespace App\Models;

use App\Actions\Log\ApprovalHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Company|null $company
 * @method static \Database\Factories\BoothFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth query()
 * @mixin \Eloquent
 */
class Booth extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['width', 'length', 'company_id', 'additional_information', 'is_approved'];

    /**
     * Establishes the relationship between the booth and
     * the company that owns it
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Handle a (dis)approval of this Booth.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleApproval(bool $isApproved): void
    {
        (new ApprovalHandler())->execute($this, $isApproved);
    }

    /**
     * Settings for the log system for this model
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn(string $eventName) => "{$this->company->name}'s booth has been {$eventName} by " . Auth::user()->name)
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(['is_approved']);
    }
}
