<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultPresentation extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'description', 'type', 'start', 'room_id', 'start', 'end'];

    /**
     * Function that retrieves the opening presentation
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public static function opening()
    {
        return self::query()
            ->where('type', '=', 'opening')
            ->first();
    }

    /**
     * Function that retrieves the closing presentation
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public static function closing()
    {
        return self::query()
            ->where('type', '=', 'closing')
            ->first();
    }
}
