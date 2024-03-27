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
     * Establishes a relationship between the company and
     * the sponsorship/sponsor tier
     * @return BelongsTo
     */
    public function sponsorship() : BelongsTo {
        return $this->belongsTo(Sponsorship::class);
    }

    /**
     * Establishes a relationship between the company and its booth
     * @return HasOne
     */
    public function booth() : HasOne {
        return $this->hasOne(Booth::class);
    }

    /**
     * Establishes a relationship between the company and the invitation
     * for users to join it
     * @return HasMany
     */
    public function invitations() : HasMany {
        return $this->hasMany(Invitation::class);
    }

    /**
     * Establishes a relationship between the company and the employees
     * @return HasMany
     */
    public function users() : HasMany {
        return $this->hasMany(User::class);
    }

    /**
     * Establishes relationship between a company and their presentations
     * NOTE 1: Not all companies have presentations
     * NOTE 2: All companies can only have one presentation except gold sponsor (they have two)
     * @return HasMany
     */
    public function presentations() : HasMany {
        return $this->hasMany(Presentation::class);
    }
}
