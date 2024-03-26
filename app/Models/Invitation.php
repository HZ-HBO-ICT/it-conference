<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

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

    /**
     * Scope a query to only retrieve the invitations for participants
     * Usage: Invitation::participants()
     * @param Builder $query
     * @return void
     */
    public function scopeParticipants(Builder $query): void {
        $query->whereNull('company_id')
            ->where('role', '=', 'participant');
    }


    /**
     * Scope a query to only retrieve the invitations for employees of companies
     * Usage: Invitation::employees()
     * @param Builder $query
     * @return void
     */
    public function scopeEmployees(Builder $query) : void {
        $query->whereNotNull('company_id');
    }

}
