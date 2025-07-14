<?php

namespace App\Models;

use App\Actions\Log\ApprovalHandler;
use App\Enums\ApprovalStatus;
use App\Traits\HasApprovalStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $website
 * @property string $description
 * @property string|null $motivation
 * @property string|null $phone_number
 * @property string $approval_status
 * @property int|null $sponsorship_id
 * @property string $sponsorship_approval_status
 * @property string|null $logo_path
 * @property string|null $dark_logo_path
 * @property string $postcode
 * @property string $street
 * @property string $house_number
 * @property string $city
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $allowed_number_of_presentation
 * @property bool $is_unlimited
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Booth|null $booth
 * @property-read mixed $booth_owners
 * @property-read mixed $booth_status
 * @property-read mixed $has_presentations_left
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InternshipAttribute> $internshipAttributes
 * @property-read int|null $internship_attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invitation> $invitations
 * @property-read int|null $invitations_count
 * @property-read mixed $is_approved
 * @property-read mixed $is_gold_sponsor
 * @property-read mixed $is_hz
 * @property-read mixed $is_sponsor
 * @property-read mixed $is_sponsorship_approved
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presentation> $presentations
 * @property-read int|null $presentations_count
 * @property-read mixed $representative
 * @property-read \App\Models\Sponsorship|null $sponsorship
 * @property-read mixed $sponsorship_status
 * @property-read mixed $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static Builder<static>|Company approvedSponsor()
 * @method static \Database\Factories\CompanyFactory factory($count = null, $state = [])
 * @method static Builder<static>|Company hasStatus(\App\Enums\ApprovalStatus|string $status, string $fieldName = 'approval_status')
 * @method static Builder<static>|Company newModelQuery()
 * @method static Builder<static>|Company newQuery()
 * @method static Builder<static>|Company orderByPriorityStatus(\App\Enums\ApprovalStatus|string $approvalStatus, string $fieldName = 'approval_status')
 * @method static Builder<static>|Company query()
 * @method static Builder<static>|Company whereApprovalStatus($value)
 * @method static Builder<static>|Company whereCity($value)
 * @method static Builder<static>|Company whereCreatedAt($value)
 * @method static Builder<static>|Company whereDarkLogoPath($value)
 * @method static Builder<static>|Company whereDeletedAt($value)
 * @method static Builder<static>|Company whereDescription($value)
 * @method static Builder<static>|Company whereHouseNumber($value)
 * @method static Builder<static>|Company whereId($value)
 * @method static Builder<static>|Company whereLogoPath($value)
 * @method static Builder<static>|Company whereMotivation($value)
 * @method static Builder<static>|Company whereName($value)
 * @method static Builder<static>|Company wherePhoneNumber($value)
 * @method static Builder<static>|Company wherePostcode($value)
 * @method static Builder<static>|Company whereSponsorshipApprovalStatus($value)
 * @method static Builder<static>|Company whereSponsorshipId($value)
 * @method static Builder<static>|Company whereStreet($value)
 * @method static Builder<static>|Company whereUpdatedAt($value)
 * @method static Builder<static>|Company whereWebsite($value)
 * @mixin \Eloquent
 */
class Company extends Model
{
    use HasFactory;
    use LogsActivity;
    use HasApprovalStatus;

    protected $fillable = ['name', 'description', 'website', 'postcode', 'approval_status', 'motivation',
        'house_number', 'street', 'city', 'logo_path', 'phone_number', 'sponsorship_id', 'sponsorship_approval_status',
        'dark_logo_path', 'allowed_number_of_presentation', 'is_unlimited'];

    /**
     * Ensures that if the company status or their sponsorship status is changed,
     * it is changed to one of the enum statuses
     * @return void
     */
    protected static function booted() : void
    {
        static::saving(function (Company $company) {
            $company->validateApprovalStatus();
            $company->validateApprovalStatus('sponsorship_approval_status');
        });
    }

    /**
     * Derived attribute that allows us to still use `is_sponsorship_approved` and minimize the
     * refactoring from the new field
     * @return Attribute<bool, never>
     */
    protected function isSponsorshipApproved() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->sponsorship_approval_status == ApprovalStatus::APPROVED->value,
        );
    }

    /**
     * Scope a query to only include companies with approved statuses
     * and approved sponsorship statuses.
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scopeApprovedSponsor(Builder $query): Builder
    {
        return $query->where('approval_status', ApprovalStatus::APPROVED->value)
            ->where('sponsorship_approval_status', ApprovalStatus::APPROVED->value);
    }

    /**
     * Establishes a relationship between the company and
     * the sponsorship/sponsor tier
     * @return BelongsTo
     */
    public function sponsorship(): BelongsTo
    {
        return $this->belongsTo(Sponsorship::class);
    }

    /**
     * Establishes a relationship between the company and its booth
     * @return HasOne
     */
    public function booth(): HasOne
    {
        return $this->hasOne(Booth::class);
    }

    /**
     * Establishes a relationship between the company and the invitation
     * for users to join it
     * @return HasMany
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    /**
     * Establishes a relationship between the company and the employees
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Establishes relationship between a company and their presentations
     * NOTE 1: Not all companies have presentations
     * NOTE 2: All companies can only have one presentation except gold sponsor (they have two)
     * @return HasMany
     */
    public function presentations(): HasMany
    {
        return $this->hasMany(Presentation::class);
    }

    /**
     * Establishes relationship between a company and the attributes of the internships they provide
     * @return HasMany
     */
    public function internshipAttributes(): HasMany
    {
        return $this->hasMany(InternshipAttribute::class);
    }

    /**
     * Settings for the log system for this model
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn(string $eventName)
            => "{$this->name} has been {$eventName}" . (Auth::user() ? " by " . Auth::user()->name : ''))
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(['approval_status', 'sponsorship_approval_status', 'sponsorship_id']);
    }

    /**
     * TODO: Fix the statuses once we determine all flows we need
     * Returns the status of the company based on the approval status
     * @return Attribute
     */
    public function status(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->approval_status == ApprovalStatus::APPROVED->value ? 'Approved' : 'Awaiting approval'
        );
    }

    /**
     *  TODO: Fix the statuses once we determine all flows we need
     * Returns the status of the company's sponsorship
     * @return Attribute
     */
    public function sponsorshipStatus(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->sponsorship) {
                    return 'Not requested';
                }
                return $this->sponsorship_approval_status == ApprovalStatus::APPROVED->value ? 'Approved' : 'Awaiting approval';
            }
        );
    }

    /**
     * Returns the status of the company's booth
     * @return Attribute
     */
    public function boothStatus(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->booth) {
                    return 'Not requested';
                }
                return $this->booth->is_approved ? 'Approved' : 'Awaiting approval';
            }
        );
    }

    /**
     * Returns the representative of the company
     * @return Attribute
     */
    public function representative(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->users()
                    ->with('roles')
                    ->role('company representative')
                    ->first();
            }
        );
    }

    /**
     * Returns the booth owners of the company
     *
     * @return Attribute
     */
    public function boothOwners(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->users()
                    ->with('roles')
                    ->role('booth owner')
                    ->get();
            }
        );
    }

    /**
     * Checks if the company is HZ University of Applied Sciences
     * @return Attribute
     */
    public function isHz(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->name == 'HZ University of Applied Sciences';
            }
        );
    }

    /**
     * Checks if the team is the gold sponsor
     * @return Attribute
     */
    public function isGoldSponsor(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->sponsorship ? $this->sponsorship->name === 'gold' && $this->is_sponsorship_approved : 0
        );
    }

    /**
     * Returns if the company is approved sponsor in general
     * @return Attribute
     */
    public function isSponsor(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->sponsorship_id && $this->is_sponsorship_approved ? $this->sponsorship : null
        );
    }

    /**
     * Calculates how many presentations does the company have left
     *
     * @return Attribute
     */
    public function hasPresentationsLeft(): Attribute
    {
        return Attribute::make(
            get: function () {
                $max_presentations = $this->allowed_number_of_presentation;
                return $this->is_approved && $this->presentations->count() < $max_presentations
                    || $this->is_unlimited;
            }
        );
    }

    /**
     * Handle a (dis)approval of this Teams request to join the conference.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleCompanyApproval(bool $isApproved): void
    {
        (new ApprovalHandler())->execute($this, $isApproved);
    }

    /**
     * Handle a (dis)approval of the company's request for a sponsorship.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleSponsorshipApproval(bool $isApproved): void
    {
        (new ApprovalHandler())->execute($this, $isApproved, 'sponsorship_approval_status');

        if ($isApproved && optional($this->sponsorship)->name == 'gold') {
            $this->update(['allowed_number_of_presentation' => 2]);
        }

        if (!$isApproved) {
            $this->disableLogging();
            $this->sponsorship_approval_status = ApprovalStatus::NOT_REQUESTED->value;
            $this->sponsorship_id = null;
            $this->save();
            $this->enableLogging();
        }
    }

    /**
     * Determine whether the passed model instance is the same as the calling one
     *
     * @param Company $company
     * @return bool
     */
    public function isSameCompany(Company $company): bool
    {
        return $this->is($company) &&
            $this->name == $company->name &&
            $this->description == $company->description &&
            $this->website == $company->website &&
            $this->phone_number == $company->phone_number &&
            $this->postcode == $company->postcode &&
            $this->house_number == $company->house_number &&
            $this->street == $company->street &&
            $this->city == $company->city;
    }
}
