<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternshipAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'company_id'];

    /**
     * Establishes relationship with the Company model
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Scopes only the attributes that are years
     * @param $query
     * @return mixed
     */
    public function scopeYears($query)
    {
        return $query->where('key', 'year');
    }

    /**
     * Scopes only the attributes that are tracks
     * @param $query
     * @return mixed
     */
    public function scopeTracks($query)
    {
        return $query->where('key', 'track');
    }

    /**
     * Scopes only the attributes that are languages
     * @param $query
     * @return mixed
     */
    public function scopeLanguages($query)
    {
        return $query->where('key', 'language');
    }
}
