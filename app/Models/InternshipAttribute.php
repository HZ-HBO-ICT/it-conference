<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property string $key The possible values are: year, language, track
 * @property string $value
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute languages()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute tracks()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InternshipAttribute years()
 * @mixin \Eloquent
 */
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
