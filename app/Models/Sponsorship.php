<?php

namespace App\Models;

use App\Enums\ApprovalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property int $max_sponsors
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read int|null $companies_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsorship awaitingApproval()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsorship newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsorship newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsorship query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsorship whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsorship whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsorship whereMaxSponsors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsorship whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsorship whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sponsorship extends Model
{
    use HasFactory;

    /**
     * Returns the icons/emojis associated with the type of sponsorship
     * @return string[]
     */
    public static function icons()
    {
        return [
            1 => '🥇',
            2 => '🥈',
            3 => '🥉'
        ];
    }

    /**
     * Establishes the relationship between a sponsorship level
     * and all the companies that have this sponsorship tier
     * @return HasMany
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Checks if there are any spots left for the specific sponsorship tier
     * @return bool
     */
    public function areMoreSponsorsAllowed()
    {
        return $this->companies()->where('sponsorship_approval_status', ApprovalStatus::APPROVED->value)
                ->count() < $this->max_sponsors;
    }

    /**
     * Calculates the number of left spots for the specific sponsorship tier
     * @return mixed
     */
    public function leftSpots()
    {
        return $this->max_sponsors - $this->companies()->where('sponsorship_approval_status', ApprovalStatus::APPROVED->value)
                ->count();
    }

    /**
     * Scope a query to only include companies that require approval
     *
     * @param $query
     * @return mixed
     */
    public function scopeAwaitingApproval($query): mixed
    {
        return $query->join('companies', 'companies.sponsorship_id', '=', 'sponsorships.id')
            ->where('companies.sponsorship_approval_status', '=', ApprovalStatus::AWAITING_APPROVAL->value);
    }

    /**
     * Checks if there are available sponsorship places
     *
     * @return bool
     */
    public static function canAddSponsor()
    {
        $availableTierNumber = Sponsorship::all()->filter(function ($tier) {
            return $tier->areMoreSponsorsAllowed();
        })->count();

        $availableTeam = Company::all()->filter(function ($team) {
            return is_null($team->sponsorship_id);
        })->count();

        return $availableTeam > 0 && $availableTierNumber > 0;
    }

    public function shine(): string
    {
        return match (strtolower($this->name)) {
            'gold' => 'rgba(255, 185, 0, 0.4)',
            'silver' => 'rgba(224, 224, 224, 0.25)',
            'bronze' => 'rgba(205, 127, 50, 0.25)',
            default => '',
        };
    }
}
