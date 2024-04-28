<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booth extends Model
{
    use HasFactory;

    protected $fillable = ['width', 'length', 'company_id', 'additional_information', 'is_approved'];

    /**
     * Establishes the relationship between the booth and
     * the company that owns it
     * @return BelongsTo
     */
    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Handle a (dis)approval of this Booth.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleApproval(bool $isApproved) : void
    {
        if ($isApproved) {
            $this->is_approved = true;
            $this->save();
        } else {
            $this->delete();
        }
    }
}
