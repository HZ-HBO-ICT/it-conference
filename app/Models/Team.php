<?php

namespace App\Models;

use App\Actions\Jetstream\DeleteTeam;
use App\Notifications\NotifyTeamApproved;
use App\Notifications\NotifyTeamDisapproved;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
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
 * @property-read Booth|null $booth
 * @property-read User $owner
 * @property-read SponsorTier|null $sponsorTier
 * @property-read Collection<int, TeamInvitation> $teamInvitations
 * @property-read int|null $team_invitations_count
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static TeamFactory factory($count = null, $state = [])
 * @method static Builder|Team newModelQuery()
 * @method static Builder|Team newQuery()
 * @method static Builder|Team query()
 * @method static Builder|Team whereCity($value)
 * @method static Builder|Team whereCreatedAt($value)
 * @method static Builder|Team whereDescription($value)
 * @method static Builder|Team whereHouseNumber($value)
 * @method static Builder|Team whereId($value)
 * @method static Builder|Team whereIsApproved($value)
 * @method static Builder|Team whereIsSponsorApproved($value)
 * @method static Builder|Team whereLogoPath($value)
 * @method static Builder|Team whereName($value)
 * @method static Builder|Team wherePersonalTeam($value)
 * @method static Builder|Team wherePostcode($value)
 * @method static Builder|Team whereSponsorTierId($value)
 * @method static Builder|Team whereStreet($value)
 * @method static Builder|Team whereUpdatedAt($value)
 * @method static Builder|Team whereUserId($value)
 * @method static Builder|Team whereWebsite($value)
 * @mixin Eloquent
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
     * All the presentations that the team has that are approved. All teams should have only one but
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
     * All the approved and awaiting presentations that the team has. All teams should have only one but
     * the gold sponsor. If there are no presentations returns an empty collection!
     * @return Attribute
     */
    public function allPresentations(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->allSpeakers->count() != 0) {
                    $presentations = [];
                    foreach ($this->allSpeakers as $user) {
                        if ($user->speaker) {
                            $presentations[] = $user->speaker->presentation()->get();
                        }
                    }

                    return collect($presentations)->flatten()->unique();
                }

                return collect([]);
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
     * Checks if the team is the golden sponsor
     * @return Attribute
     */
    public function isGoldenSponsor(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->sponsorTier ? $this->sponsorTier->name === 'golden' && $this->is_sponsor_approved : 0
        );
    }

    /**
     * Checks if the team is the golden sponsor
     * @return Attribute
     */
    public function hasPresentationsLeft(): Attribute
    {
        return Attribute::make(
            get: function() {
                $max_presentations = $this->is_golden_sponsor ? 2 : 1;
                return $this->is_approved && $this->all_presentations->count() < $max_presentations;
            }
        );
    }

    /**
     * Handle a (dis)approval of this Teams request to join the conference.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleTeamApproval(bool $isApproved): void
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
    public function handleSponsorshipApproval(bool $isApproved): void
    {
        if ($isApproved) {
            $this->is_sponsor_approved = true;
            $this->save();

            if ($this->sponsorTier->leftSpots() == 0)
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
