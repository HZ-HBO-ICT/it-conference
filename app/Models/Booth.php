<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Booth
 *
 * @property int $id
 * @property string $width
 * @property string $length
 * @property string $additional_information
 * @property int $is_approved
 * @property int $team_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|Booth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booth query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booth whereAdditionalInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booth whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booth whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booth whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booth whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booth whereWidth($value)
 * @mixin \Eloquent
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
}
