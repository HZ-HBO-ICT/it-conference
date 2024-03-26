<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booth extends Model
{
    use HasFactory;

    /**
     * Establishes the relationship between the booth and
     * the company that owns it
     * @return BelongsTo
     */
    public function company() : BelongsTo {
        return $this->belongsTo(Company::class);
    }
}
