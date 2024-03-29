<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * Establishes a relationship between the user and the company they're part of
     * (if they have a company)
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Hides a many-to-many relationship with presentations
     * and implements relationship with linking table UserPresentation
     * Please don't use this, instead refer to the methods below
     * @return HasMany
     */
    public function userPresentations(): HasMany
    {
        return $this->hasMany(UserPresentation::class);
    }

    /**
     * Assign the user to a presentation, based on the role that
     * was passed - participant or speaker
     * @param $presentation
     * @param string $role
     * @return void
     */
    public function joinPresentation($presentation, string $role = 'participant'): void
    {
        UserPresentation::create([
            'user_id' => $this->id,
            'presentation_id' => $presentation->id,
            'role' => $role
        ]);
    }

    /**
     * Dis-enrol participant from a presentation
     * @param $presentation
     * @return void
     */
    public function leavePresentation($presentation)
    {
        $userPresentation = $this->userPresentations
            ->where('role', 'participant')
            ->where('presentation_id', $presentation->id)
            ->first();

        $userPresentation->delete();
    }

    /**
     * Returns the presentation of which the user is a speaker
     * @return Attribute
     */
    public function speaking(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->userPresentations->where('role', 'speaker')->first()->presentation,
        );

    }

    /**
     * Returns the presentations in which the user enrolled to
     * be a participant
     * @return Attribute
     */
    public function participating(): Attribute
    {
        return Attribute::make(
            get: fn() => Presentation::whereHas('userPresentations', function ($query) {
                $query->where('user_id', $this->id)
                    ->where('role', 'participant');
            })->get(),
        );
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
