<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Booth
 *
 * @property int $id
 * @property string $width
 * @property string $length
 * @property string $additional_information
 * @property int $is_approved
 * @property int $team_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Team $team
 * @method static Builder|Booth newModelQuery()
 * @method static Builder|Booth newQuery()
 * @method static Builder|Booth query()
 * @method static Builder|Booth whereAdditionalInformation($value)
 * @method static Builder|Booth whereCreatedAt($value)
 * @method static Builder|Booth whereId($value)
 * @method static Builder|Booth whereIsApproved($value)
 * @method static Builder|Booth whereLength($value)
 * @method static Builder|Booth whereTeamId($value)
 * @method static Builder|Booth whereUpdatedAt($value)
 * @method static Builder|Booth whereWidth($value)
 * @mixin Eloquent
 */
class Booth extends Model
{
    protected $fillable = ['width', 'length', 'additional_information', 'team_id'];

    use HasFactory;

    /**
     * The team/company that owns this booth
     * @return BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Handle a (dis)approval of this Booth.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleApproval(bool $isApproved) : void
    {
        if ($isApproved) {
            $this->is_approved = true;
            $this->save();
        } else {
            $this->delete();
        }
    }

    /**
     * Scope a query to only include companies that require approval
     *
     * @param $query
     * @return mixed
     */
    public function scopeAwaitingApproval($query): mixed
    {
        return $query->where('is_approved', '=', 0);
    }
}
