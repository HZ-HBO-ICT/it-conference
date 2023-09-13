<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventInstance extends Model
{
    use HasFactory;

    const STATE_NEW = 0;
    const STATE_DESIGN = 10;
    const STATE_ENROLLMENT = 20;
    const STATE_EXECUTION = 30;
    const STATE_ARCHIVE = 40;
}
