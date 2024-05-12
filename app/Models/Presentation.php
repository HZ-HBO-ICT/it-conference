<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Presentation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'max_participants', 'description', 'type', 'difficulty_id', 'file_path',
        'room_id', 'timeslot_id', 'start'];

    /**
     * Returns the basic validation rules for the model
     * @return string[]
     */
    public static function rules()
    {
        return [
            'name' => 'required',
            'max_participants' => 'required|numeric|min:1',
            'description' => 'required',
            'type' => 'required|in:workshop,lecture',
            'difficulty_id' => 'required',
        ];
    }

    /**
     * Hard-coding the duration of the lectures
     * TODO: Once the metatables get added rework this to retrieve data from there
     * @var int
     */
    public static $LECTURE_DURATION = 30;

    /**
     * Hard-coding the duration of the workshops
     * TODO: Once the metatables get added rework this to retrieve data from there
     * @var int
     */
    public static $WORKSHOP_DURATION = 90;

    /**
     * Establishes a relationship between the presentation
     * and its difficulty
     * @return BelongsTo
     */
    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }

    /**
     * Establishes a relationship between the presentation and
     * the timeslot it's assigned to
     * @return BelongsTo
     */
    public function timeslot(): BelongsTo
    {
        return $this->belongsTo(Timeslot::class);
    }

    /**
     * Establishes a relationship between the presentation and
     * the room it's assigned to
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Establishes a relationship between the presentations and the company
     * NOTE: Not all the presentations have a company (there are independent speakers)
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Hides a many-to-many relationship with users
     * and implements relationship with linking table UserPresentation
     * @return HasMany
     */
    public function userPresentations(): HasMany
    {
        return $this->hasMany(UserPresentation::class);
    }

    /**
     * Retrieves all users that have enrolled in the presentation as participants
     * @return Attribute
     */
    public function participants(): Attribute
    {
        return Attribute::make(
            get: fn() => User::whereHas('userPresentations', function ($query) {
                $query->where('presentation_id', $this->id)
                    ->where('role', 'participant');
            })->get(),
        );
    }

    /**
     * Retrieves all the speakers of the presentation
     * @return Attribute
     */
    public function speakers(): Attribute
    {
        return Attribute::make(
            get: fn() => User::whereHas('userPresentations', function ($query) {
                $query->where('presentation_id', $this->id)
                    ->where('role', 'speaker');
            })->get(),
        );
    }

    /**
     * Checks if the presentation can be deleted
     */
    public function canBeDeleted(): bool
    {
        return !EventInstance::current()->is_final_programme_released;
    }

    /**
     * Handle a (dis)approval of this Presentation.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleApproval(bool $isApproved): void
    {
        if ($isApproved) {
            $this->is_approved = true;
            $this->save();
        } else {
            $this->delete();
        }
    }
}
