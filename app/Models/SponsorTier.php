<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SponsorTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'max_presentations',
        'max_booths',
        'max_representatives',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'sponsorship_id');
    }
} 