<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'website', 'postcode',
        'house_number', 'street', 'city', 'logo_path', 'phone_number'];

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
     * Returns the status of the company based on the approval status
     * @return Attribute
     */
    public function status(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->is_approved ? 'Approved' : 'Awaiting approval'
        );
    }

    /**
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
                return $this->sponsorship->is_approved ? 'Approved' : 'Awaiting approval';
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
     * Checks if the company is HZ University of Applied Sciences
     * @return Attribute
     */
    public function isHz() : Attribute
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
            get: fn() => $this->sponsorship ? $this->sponsorship->name === 'gold' && $this->is_sponsorhip_approved : 0
        );
    }

    /**
     * Calculates how many presentations does the company have left
     * @return Attribute
     */
    public function hasPresentationsLeft(): Attribute
    {
        return Attribute::make(
            get: function () {
                $max_presentations = $this->is_gold_sponsor ? 2 : 1;
                return $this->is_approved && $this->presentations->count() < $max_presentations;
            }
        );
    }
}