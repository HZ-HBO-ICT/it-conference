<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'title', 'content', 'reported_by_id'];

    public static $rules = [
        'type' => 'required|in:organization,website',
        'title' => 'required|max:255|string',
        'content' => 'required|max:1500|string',
    ];

    /**
     * Establishes connection to the user who gave the feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by_id');
    }
}
