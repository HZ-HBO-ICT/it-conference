<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FrequentQuestion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FrequentQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'category'];
}
