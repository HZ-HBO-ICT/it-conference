<?php

namespace App\Models;

use App\Actions\Jetstream\DeleteTeam;
use App\Notifications\NotifyTeamApproved;
use App\Notifications\NotifyTeamDisapproved;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $personal_team
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $postcode
 * @property string $house_number
 * @property string $street
 * @property string $city
 * @property string $website
 * @property string $description
 * @property int $is_approved
 * @property int|null $sponsor_tier_id
 * @property int|null $is_sponsor_approved
 * @property string|null $logo_path
 * @property-read \App\Models\Booth|null $booth
 * @property-read \App\Models\User $owner
 * @property-read \App\Models\SponsorTier|null $sponsorTier
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TeamInvitation> $teamInvitations
 * @property-read int|null $team_invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\TeamFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereIsSponsorApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereLogoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team wherePersonalTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereSponsorTierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereWebsite($value)
 * @mixin \Eloquent
 */
class Team extends JetstreamTeam
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',
        'postcode',
        'house_number',
        'street',
        'city',
        'website',
        'is_approved',
        'description',
        'logo_path'
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    /**
     * The sponsor tier of the team/company (if they have one)
     * @return BelongsTo
     */
    public function sponsorTier(): BelongsTo
    {
        return $this->belongsTo(SponsorTier::class);
    }

    /**
     * The booth associated with the team (if they have one)
     * @return HasOne
     */
    public function booth(): HasOne
    {
        return $this->hasOne(Booth::class);
    }

    /**
     * All the speakers that are in the team and are approved.
     * (Approved means that they have a global (spatie) role speaker)
     * @return Attribute
     */
    public function speakers(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->users()->role('speaker')->get(),
        );
    }

    /**
     * All the speakers that are within a team, even though they may not
     * be approved globally
     * @return Attribute
     */
    public function allSpeakers(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->users()->wherePivot('role', 'speaker')->get(),
        );
    }

    /**
     * All the presentations that the team has. All teams should have only one but
     * the gold sponsor.
     * @return Attribute
     */
    public function presentations(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->speakers->count() != 0) {
                    $presentations = [];
                    foreach ($this->speakers as $user) {
                        $presentations[] = $user->speaker->presentation()->get();
                    }

                    return collect($presentations)->flatten();
                }

                return null;
            }
        );
    }

    /**
     * Checks if currently there is a pending request for a presentation
     * by the team
     * @return Attribute
     */
    public function hasPendingPresentationRequest(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->users()->whereHas('speaker', function ($query) {
                    $query->where('is_approved', 0)->where('is_main_speaker', 1);
                })->wherePivot('role', 'speaker')->exists();
            }
        );
    }

    /**
     * Handle a (dis)approval of this Teams request to join the conference.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleTeamApproval(bool $isApproved) : void
    {
        if ($isApproved) {
            $this->is_approved = true;
            $this->owner->assignRole('company representative');
            $this->save();
        } else {
            $deleteTeam = new DeleteTeam();
            $deleteTeam->delete($this);
        }
    }

    /**
     * Handle a (dis)approval of this Teams request for a sponsorship.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleSponsorshipApproval(bool $isApproved) : void
    {
        if ($isApproved) {
            $this->is_sponsor_approved = true;
            $this->save();

            if($this->sponsorTier->leftSpots() == 0)
                $this->sponsorTier->rejectAllExceptApproved();

            if ($this->booth) {
                if ($this->sponsorTier->name == 'golden') {
                    $this->booth->width = 2;
                    $this->booth->length = 6;
                } else {
                    $this->booth->width = 2;
                    $this->booth->length = 4;
                }
                $this->booth->save();
            }
        } else {
            $this->is_sponsor_approved = null;
            $this->sponsor_tier_id = null;
            $this->save();
        }
    }
}
