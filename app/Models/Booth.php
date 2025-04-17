<?php

namespace App\Models;

use App\Actions\Log\ApprovalHandler;
use App\Enums\ApprovalStatus;
use App\Traits\HasApprovalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 *
 *
 * @property int $id
 * @property string $width
 * @property string $length
 * @property int $company_id
 * @property string|null $additional_information
 * @property string $approval_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Company $company
 * @property-read mixed $is_approved
 * @method static \Database\Factories\BoothFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth hasStatus(\App\Enums\ApprovalStatus|string $status, string $fieldName = 'approval_status')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth orderByPriorityStatus(\App\Enums\ApprovalStatus|string $approvalStatus, string $fieldName = 'approval_status')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth whereAdditionalInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth whereApprovalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booth whereWidth($value)
 * @mixin \Eloquent
 */
class Booth extends Model
{
    use HasFactory;
    use LogsActivity;
    use HasApprovalStatus;

    protected $fillable = ['width', 'length', 'company_id', 'additional_information', 'approval_status'];

    /**
     * Ensures that if the booth status is changed, it is changed to one of the enum statuses
     * @return void
     */
    protected static function booted() : void
    {
        static::saving(function (Booth $booth) {
            $booth->validateApprovalStatus();
        });
    }

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
            ->dontLogIfAttributesChangedOnly(['approval_status']);
    }
}
