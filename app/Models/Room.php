<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\RoomFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Room
 *
 * @property int $id
 * @property string $name
 * @property int $max_participants The max number of participants that the room allows
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Presentation> $presentations
 * @property-read int|null $presentations_count
 * @method static RoomFactory factory($count = null, $state = [])
 * @method static Builder|Room newModelQuery()
 * @method static Builder|Room newQuery()
 * @method static Builder|Room query()
 * @method static Builder|Room whereCreatedAt($value)
 * @method static Builder|Room whereId($value)
 * @method static Builder|Room whereMaxParticipants($value)
 * @method static Builder|Room whereName($value)
 * @method static Builder|Room whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'max_participants'];

    public static function rules()
    {
        return [
            'name' => 'required|unique:rooms',
            'max_participants' => 'required|numeric|min:1'
        ];
    }

    /**
     * All the presentations that are in the room
     * @return HasMany
     */
    public function presentations(): HasMany
    {
        return $this->hasMany(Presentation::class);
    }

    /**
     * Checks if this room can be deleted.
     *
     * @return Attribute
     */
    public function canBeDeleted(): Attribute
    {
        return Attribute::make(
            get: fn() => true
        );

    }

    /**
     * List with the rooms with the closest capacity to the maximum participants passed
     * @param $maxCapacity
     * @return mixed
     */
    public static function getWithClosestCapacity($maxCapacity)
    {
        return Room::select('*')
            ->selectRaw('CAST(max_participants AS SIGNED) AS signed_capacity')
            ->orderByRaw('ABS(signed_capacity - ?)', [$maxCapacity])
            ->get();
    }
}
