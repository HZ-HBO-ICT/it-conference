<?php

namespace App\Models;

use App\Mail\SponsorshipDisapproved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Mail;

/**
 * App\Models\SponsorTier
 *
 * @property int $id
 * @property string $name
 * @property int $max_sponsors The maximum companies that can have that tier
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $teams
 * @property-read int|null $teams_count
 * @method static \Illuminate\Database\Eloquent\Builder|SponsorTier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SponsorTier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SponsorTier query()
 * @method static \Illuminate\Database\Eloquent\Builder|SponsorTier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SponsorTier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SponsorTier whereMaxSponsors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SponsorTier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SponsorTier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SponsorTier extends Model
{
    use HasFactory;

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
                Mail::to($team->owner->email)->send(new SponsorshipDisapproved($team));

                $team->sponsor_tier_id = null;
                $team->is_sponsor_approved = null;
                $team->save();
            }
        }
    }
}
