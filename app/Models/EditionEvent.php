<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EditionEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'edition_id',
        'start_at',
        'end_at'
    ];

    public static function rules(): array
    {
        return [
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date',
        ];
    }

    /**
     * Establishes a relationship between EditionEvent and Edition models
     * @return BelongsTo
     */
    public function edition(): BelongsTo
    {
        return $this->belongsTo(Edition::class);
    }

    /**
     * Establishes a relationship between EditionEvent and Event models
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}