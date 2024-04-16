<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class MemberManager extends Component
{
    public Company $company;

    /**
     * Indicates if a user's role is currently being managed.
     *
     * @var bool
     */
    public $currentlyManagingRole = false;

    /**
     * The user that is having their role managed.
     *
     * @var mixed
     */
    public $managingRoleFor;

    /**
     * The current role for the user that is having their role managed.
     *
     * @var string
     */
    public $currentRole;

    /**
     * Indicates if the application is confirming if a user wishes to leave the current team.
     *
     * @var bool
     */
    public $confirmingLeavingTeam = false;

    /**
     * Indicates if the application is confirming if a team member should be removed.
     *
     * @var bool
     */
    public $confirmingTeamMemberRemoval = false;

    /**
     * The ID of the team member being removed.
     *
     * @var int|null
     */
    public $teamMemberIdBeingRemoved = null;

    /**
     * The "add team member" form state.
     *
     * @var array
     */
    public $addTeamMemberForm = [
        'email' => '',
        'role' => null,
    ];

    /**
     * Called when initializing the component
     *
     * @param $company
     * @return void
     */
    public function mount($company){
        $this->company = $company;
    }

    #[On('user-removed')]
    public function refresh()
    {
        $this->company = $this->company->fresh();
    }

    /**
     * Add a new team member to a team.
     *
     * @return void
     */
    public function addTeamMember()
    {
        $this->resetErrorBag();

        /*if (Features::sendsTeamInvitations()) {
            app(InvitesTeamMembers::class)->invite(
                $this->user,
                $this->team,
                $this->addTeamMemberForm['email'],
                $this->addTeamMemberForm['role']
            );
        } else {
            app(AddsTeamMembers::class)->add(
                $this->user,
                $this->team,
                $this->addTeamMemberForm['email'],
                $this->addTeamMemberForm['role']
            );
        }*/

        $this->addTeamMemberForm = [
            'email' => '',
            'role' => null,
        ];

        $this->team = $this->team->fresh();

/*        $this->dispatch('saved');*/
    }

    /**
     * Cancel a pending team member invitation.
     *
     * @param  int  $invitationId
     * @return void
     */
    public function cancelTeamInvitation($invitationId)
    {
        /*if (! empty($invitationId)) {
            $model = Jetstream::teamInvitationModel();

            $model::whereKey($invitationId)->delete();
        }*/

        $this->team = $this->team->fresh();
    }

    /**
     * Allow the given user's role to be managed.
     *
     * @param  int  $userId
     * @return void
     */
    public function manageRole($userId)
    {
        $this->currentlyManagingRole = true;
        $this->managingRoleFor = $this->company->users->find($userId);
        $this->currentRole = $this->managingRoleFor->getRoleNames()->first(function ($name) {
            return $name != 'participant';
        });
    }

    /**
     * Save the role for the user being managed.
     *
     * @param  \Laravel\Jetstream\Actions\UpdateTeamMemberRole  $updater
     * @return void
     */
    public function updateRole()
    {
        $this->managingRoleFor->syncRoles(['participant', $this->currentRole]);
        $this->managingRoleFor = $this->managingRoleFor->fresh();
        $this->company = $this->company->refresh();

        $this->stopManagingRole();
    }

    /**
     * Stop managing the role of a given user.
     *
     * @return void
     */
    public function stopManagingRole()
    {
        $this->currentlyManagingRole = false;
    }

    /**
     * Remove the currently authenticated user from the team.
     *
     * @param  \Laravel\Jetstream\Contracts\RemovesTeamMembers  $remover
     * @return \Illuminate\Http\RedirectResponse
     */
    public function leaveTeam(RemovesTeamMembers $remover)
    {
        /*$remover->remove(
            $this->user,
            $this->team,
            $this->user
        );

        $this->confirmingLeavingTeam = false;

        $this->team = $this->team->fresh();

        return redirect(config('fortify.home'));*/
    }

    /**
     * Confirm that the given team member should be removed.
     *
     * @param  int  $userId
     * @return void
     */
    public function confirmTeamMemberRemoval($userId)
    {
        /*$this->confirmingTeamMemberRemoval = true;

        $this->teamMemberIdBeingRemoved = $userId;*/
    }

    /**
     * Remove a team member from the team.
     *
     * @return void
     */
    public function removeTeamMember()
    {
       /* $remover->remove(
            $this->user,
            $this->team,
            $user = Jetstream::findUserByIdOrFail($this->teamMemberIdBeingRemoved)
        );

        $this->confirmingTeamMemberRemoval = false;

        $this->teamMemberIdBeingRemoved = null;*/

        $this->team = $this->team->fresh();
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Get the available team member roles.
     *
     * @return array
     */
    public function getRolesProperty()
    {
        return [
            [
                'name' => 'speaker',
                'description' => 'blq blq'
            ],
            [
                'name' => 'booth owner',
                'description' => 'blq blq blq'
            ]
        ];
        /*return collect(Jetstream::$roles)->transform(function ($role) {
            return with($role->jsonSerialize(), function ($data) {
                return (new Role(
                    $data['key'],
                    $data['name'],
                    $data['permissions']
                ))->description($data['description']);
            });
        })->values()->all();*/
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.company.member-manager');
    }
}
