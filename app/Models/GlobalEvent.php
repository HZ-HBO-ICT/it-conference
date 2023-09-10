<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalEvent extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public static function isFinalProgrammeReleased()
    {
        return GlobalEvent::where('type', 'App\Events\FinalProgrammeReleased')->exists();
    }
}
