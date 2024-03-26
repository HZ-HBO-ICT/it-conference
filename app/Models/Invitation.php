<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    use HasFactory;

    /**
     * Establishes relationship between the invitations and the company
     * @return BelongsTo
     */
    public function company() : BelongsTo {
        return $this->belongsTo(Company::class);
    }
}
