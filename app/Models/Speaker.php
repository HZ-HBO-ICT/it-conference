<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'bio',
        'company_id',
        'presentation_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }
} 