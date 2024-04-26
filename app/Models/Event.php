<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Establishes the relationship between Event and EditionEvent models
     * @return HasMany
     */
    public function editionEvents(): HasMany
    {
        return $this->hasMany(EditionEvent::class);
    }
}
