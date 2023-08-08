<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
