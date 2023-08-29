<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Speaker extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'presentation_id', 'is_main_speaker', 'is_approved'];

    /**
     * The presentation the speaker has
     * @return BelongsTo
     */
    public function presentation(): BelongsTo
    {
        return $this->belongsTo(Presentation::class);
    }

    /**
     * The user that is going to be speaker at the presentation
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Approves the speaker and makes it a global speaker
     * @return void
     */
    public function approve() : void
    {
        $this->is_approved = 1;
        $this->user->assignRole('speaker');
        $this->save();
    }
}
