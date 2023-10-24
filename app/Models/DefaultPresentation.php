<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultPresentation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'type', 'room_id', 'timeslot_id'];

    public static function opening()
    {
        return self::query()
            ->where('type', '=', 'opening')
            ->first();
    }

    public static function closing()
    {
        return self::query()
            ->where('type', '=', 'closing')
            ->first();
    }

    public function timeslot()
    {
        return $this->belongsTo(Timeslot::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
