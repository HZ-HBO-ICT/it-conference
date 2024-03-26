<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    /**
     * Establishes relationship between the company and
     * the sponsorship/sponsor tier
     * @return BelongsTo
     */
    public function sponsorship() : BelongsTo {
        return $this->belongsTo(Sponsorship::class);
    }

    /**
     * Establishes relationship between the company and its booth
     * @return HasOne
     */
    public function booth() : HasOne {
        return $this->hasOne(Booth::class);
    }

    /**
     * Establishes relationship between the company and the invitation
     * for users to join it
     * @return HasMany
     */
    public function invitations() : HasMany {
        return $this->hasMany(Invitation::class);
    }
}
