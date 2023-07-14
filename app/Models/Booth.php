<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booth extends Model
{
    protected $fillable = ['width', 'length', 'additional_information', 'team_id'];

    use HasFactory;

    /**
     * The team/company that owns this booth
     * @return BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
