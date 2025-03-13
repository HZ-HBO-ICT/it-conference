<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * 
 *
 * @property-read \App\Models\Company|null $company
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation employees()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation participants()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation query()
 * @mixin \Eloquent
 */
class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'company_id', 'role'];

    /**
     * Establishes relationship between the invitations and the company
     * @return BelongsTo
     */
    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Scope a query to only retrieve the invitations for participants
     * Usage: Invitation::participants()
     * @param Builder $query
     * @return void
     */
    public function scopeParticipants(Builder $query): void
    {
        $query->whereNull('company_id')
            ->where('role', '=', 'participant');
    }


    /**
     * Scope a query to only retrieve the invitations for employees of companies
     * Usage: Invitation::employees()
     * @param Builder $query
     * @return void
     */
    public function scopeEmployees(Builder $query) : void
    {
        $query->whereNotNull('company_id');
    }
}
