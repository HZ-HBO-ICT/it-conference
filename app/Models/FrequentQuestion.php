<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion query()
 * @mixin \Eloquent
 */
class FrequentQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer'];
}
