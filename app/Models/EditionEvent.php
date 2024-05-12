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

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    /**
     * Returns basic validation rules for EditionEvent
     * @return string[]
     */
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

    /**
     * Synchronize start date of the event to the current date
     * @return void
     */
    public function syncStartDate(): void
    {
        $this->start_at = date('Y-m-d');
        $this->save();
    }

    /**
     * Synchronize end date of the event to the current date
     * @return void
     */
    public function syncEndDate(): void
    {
        $this->end_at = date('Y-m-d');

        $this->save();
    }
}
