<?php

namespace App\Models;

use App\Mail\SponsorshipDisapproved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Mail;

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
                Mail::to($team->owner->email)->send(new SponsorshipDisapproved($team));

                $team->sponsor_tier_id = null;
                $team->is_sponsor_approved = null;
                $team->save();
            }
        }
    }
}
