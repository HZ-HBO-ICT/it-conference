<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\HtmlString;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Nette\Schema\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use CausesActivity;


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
     * Establish relationship with Ticket
     *
     * @return HasOne
     */
    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }

    /**
     * Hides a many-to-many relationship with presentations
     * and implements relationship with linking table UserPresentation
     * Please don't use this, instead refer to the methods below
     *
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
     *
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

        if ($this->hasRole('pending speaker')) {
            $this->removeRole('pending speaker');
        }

        return true;
    }

    /**
     * Disneroll participant from a presentation
     *
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
     *
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
     *
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
        return $company && $this->company && $this->company->id == $company->id;
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
     * Definition of the `is_crew` read-only attribute that is `true`
     * if the user has one or more roles that resembles a Crew member,
     * like organizers and supervisors.
     *
     * @return Attribute
     */
    public function isCrew(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->hasRole(['event organizer', 'assistant organizer',
                'company market supervisor', 'speakers supervisor', 'pr lead',
                'entertainment organizer'])
        );
    }

    /**
     * Determines the color scheme of the hub area based on the user's role
     *
     * @return Attribute
     */
    public function roleColour(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->company) {
                    return 'partner';
                } elseif ($this->is_crew) {
                    return 'apricot-peach';
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
        $query->role(['participant'])
            ->where('email', 'not like', '%@hz.nl') // Exclude emails ending with '@hz.nl'
            ->orderBy('name');
    }

    /**
     * Determines whether the user is simply a company member.
     * This means they are not speaker, representative or booth owner.
     *
     * @return Attribute
     */
    public function isDefaultCompanyMember(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->hasExactRoles(['participant', 'company member'])
                && $this->company
                && is_null($this->presenter_of)
        );
    }

    /**
     * Returns all of the roles of the user
     *
     * @return Attribute
     */
    public function allRoles(): Attribute
    {
        return Attribute::make(
            get: function () {
                $roles = $this->getRoleNames();

                if ($this->presenter_of) {
                    $roles->push('speaker');
                }

                return $roles;
            }
        );
    }

    /**
     * Creates an array with the main roles of the user
     * if they have roles other than the participant one
     *
     * @return \Illuminate\Support\Collection
     */
    public function mainRoles()
    {
        $roles = $this->all_roles;

        if ($roles->count() > 1) {
            $roles = $roles->reject(function ($role) {
                return $role === 'participant';
            });
        }

        return $roles->map(function ($role) {
            return ucfirst($role);
        });
    }

    /**
     * Scope for all users that have their email notifications activated
     *
     * @param Builder $query
     * @return void
     */
    public function scopeSendEmailPreference(Builder $query) : void
    {
        $query->where('receive_emails', '=', 1);
    }

    /**
     * Scope all users and order them by their tickets
     *
     * @param Builder $query
     * @return void
     */
    public function scopeUsersWithTickets(Builder $query)
    {
        $query->select('users.*', 'tickets.scanned_at')
            ->leftJoin('tickets', 'users.id', '=', 'tickets.user_id')
            ->orderBy('tickets.scanned_at', 'desc')
            ->orderBy('users.name');
    }

    /**
     * Determine the status of the user's ticket
     *
     * @return Attribute
     */
    public function ticketStatus(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->is_crew) {
                    return [
                        'status' => 'Crew',
                        'color' => 'sky',
                        'icon' => 'M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z',
                        ];
                }

                if ($this->ticket) {
                    return $this->ticket->scanned_at ?
                        [
                            'status' => 'Scanned',
                            'color' => 'green',
                            'icon' => 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                        ] :
                        [
                            'status' => 'Ticket sent',
                            'color' => 'yellow',
                            'icon' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                        ];
                }

                return [
                    'status' => 'Not verified',
                    'color' => 'red',
                    'icon' => 'm9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                    ];
            }
        );
    }

    /**
     * Generates a QR code with user's data
     *
     * @return HtmlString
     */
    public function generateTicket(): HtmlString
    {
        return QrCode::size(200)
            ->format('png')
            ->merge('/public/img/logo-small-' . $this->role_colour . '.png')
            ->errorCorrection('M')
            ->generate('id=' . $this->id . ';' . 'token=' . $this->ticket->token);
    }
}
