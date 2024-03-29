<?php

namespace App\Models;

use App\Mail\SponsorshipDisapprovedMailable;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

/**
 * App\Models\SponsorTier
 *
 * @property int $id
 * @property string $name
 * @property int $max_sponsors The maximum companies that can have that tier
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Team> $teams
 * @property-read int|null $teams_count
 * @method static Builder|SponsorTier newModelQuery()
 * @method static Builder|SponsorTier newQuery()
 * @method static Builder|SponsorTier query()
 * @method static Builder|SponsorTier whereCreatedAt($value)
 * @method static Builder|SponsorTier whereId($value)
 * @method static Builder|SponsorTier whereMaxSponsors($value)
 * @method static Builder|SponsorTier whereName($value)
 * @method static Builder|SponsorTier whereUpdatedAt($value)
 * @mixin Eloquent
 */
class SponsorTier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'max_sponsors'];

    /**
     * All the teams that have this sponsorship tier
     * @return HasMany
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function areMoreSponsorsAllowed()
    {
        return $this->teams()->where('is_sponsor_approved', '=', 1)->count() < $this->max_sponsors;
    }

    public function leftSpots()
    {
        return $this->max_sponsors - $this->teams()->where('is_sponsor_approved', '=', 1)->count();
    }

    /**
     * Reject all companies that have requested this sponsorship but are not approved
     * @return void
     */
    public function rejectAllExceptApproved()
    {
        foreach ($this->teams as $team) {
            if (!$team->is_sponsor_approved) {
                Mail::to($team->owner->email)->send(new SponsorshipDisapprovedMailable($team));

                $team->sponsor_tier_id = null;
                $team->is_sponsor_approved = null;
                $team->save();
            }
        }
    }

    /**
     * Scope a query to only include companies that require approval
     *
     * @param $query
     * @return mixed
     */
    public function scopeAwaitingApproval($query): mixed
    {
        return $query->join('teams', 'teams.sponsor_tier_id', '=', 'sponsor_tiers.id')
            ->where('teams.is_sponsor_approved', '=', 0);
    }

    public static function canAddSponsor()
    {
        $availableTierNumber = SponsorTier::all()->filter(function ($tier) {
            return $tier->areMoreSponsorsAllowed();
        })->count();

        $availableTeam = Team::all()->filter(function ($team) {
            return is_null($team->sponsor_tier_id);
        })->count();

        return $availableTeam > 0 && $availableTierNumber > 0;
    }
}
