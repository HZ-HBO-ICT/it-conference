<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

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
            get: fn() => $this->sponsorTier ? $this->sponsorTier->name === 'golden' : 0
        );
    }
}
