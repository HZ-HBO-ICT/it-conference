<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Nette\Schema\ValidationException;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'institution'
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
     * Returns true if the user successfully was added to the presentation with their role;
     * Returns false if the user wasn't attached to the presentation
     * @param $presentation
     * @param string $role
     * @return bool
     */
    public function joinPresentation($presentation, string $role = 'participant'): bool
    {
        if ($this->presenter_of) {
            // The user is already a speaker of another presentation
            if ($role == 'speaker') {
                return false;
            }

            // The user is a speaker of this presentation, and cannot be a participant
            if ($this->presenter_of->id == $presentation->id && $role == 'participant') {
                return false;
            }
        }

        // The user is already enrolled as a participant in this presentation
        if ($this->participating_in->contains($presentation)) {
            return false;
        }

        UserPresentation::create([
            'user_id' => $this->id,
            'presentation_id' => $presentation->id,
            'role' => $role
        ]);

        return true;
    }

    /**
     * Disneroll participant from a presentation
     * @param $presentation
     * @return void
     */
    public function leavePresentation($presentation)
    {
        $userPresentation = $this->userPresentations
            ->where('role', 'participant')
            ->where('presentation_id', $presentation->id)
            ->first();

        if (!is_null($userPresentation)) {
            $userPresentation->delete();
        }
    }

    /**
     * Returns the presentation of which the user is a speaker
     * @return Attribute
     */
    public function presenterOf(): Attribute
    {
        return Attribute::make(
            get: fn() => Presentation::whereHas('userPresentations', function ($query) {
                $query->where('user_id', $this->id)
                    ->where('role', 'speaker');
            })->first(),
        );
    }

    /**
     * Returns the presentations in which the user enrolled to
     * be a participant
     * @return Attribute
     */
    public function participatingIn(): Attribute
    {
        return Attribute::make(
            get: fn() => Presentation::whereHas('userPresentations', function ($query) {
                $query->where('user_id', $this->id)
                    ->where('role', 'participant');
            })->get(),
        );
    }

    /**
     * Determines whether the user is a member of the specified company.
     *
     * @param Company $company
     * @return bool
     */
    public function isMemberOf(Company $company): bool
    {
        return $company && $this->company && $this->company->id = $company->id;
    }

    /**
     * Determines whether the user is a presenter of the specified presentation.
     *
     * @param Presentation $presentation
     * @return bool
     */
    public function isPresenterOf(Presentation $presentation)
    {
        return $this->presenter_of
            && $this->presenter_of->id == $presentation->id;
    }

    /**
     * Definition of the `is_backend_user` read-only attribute that is `true`
     * if the user is a 'Backend user'; a user that uses the backend section
     * if the app, like admins and other crew.
     *
     * @return Attribute
     */
    public function isBackendUser(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->hasRole('crew')
        );
    }

    /**
     * Checks if the user can be enrolled to this presentation, based on the
     * event status and the max_participants
     * TODO: add user schedule clashing
     *
     * @param Presentation $presentation
     * @return bool
     */
    public function canEnroll(Presentation $presentation) : bool
    {
        if (!EventInstance::current()->is_final_programme_released) {
            return false;
        }

        return $presentation->remaining_capacity > 0;
    }

    /**
     * Determines the color scheme of the hub area based on the user's role
     * @return Attribute
     */
    public function roleColour() : Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->company) {
                    return 'partner';
                } elseif ($this->hasRole('event organizer')) {
                    return 'crew';
                } else {
                    return 'participant';
                }
            }
        );
    }


    /**
     * Scope a query to only include users who can be company representatives.
     */
    public function scopeForCompanyRep(Builder $query): void
    {
        // Only user who:
        // Do not have an @hz.nl
        $query->role(['participant', 'speaker'])
        ->where('email', 'not like', '%@hz.nl') // Exclude emails ending with '@hz.nl'
        ->orderBy('name');
    }
}
