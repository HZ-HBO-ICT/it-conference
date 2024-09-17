<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    /**
     * Determine if the user can see the list of companies
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny company');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Company $company): bool
    {
        // Edge case since the speaker doesn't have a role that I can give permission to
        if ($user->isMemberOf($company) && $user->presenter_of) {
            return true;
        }

        return ($user->is_crew || $user->isMemberOf($company))
            && $user->can('view company');
    }

    /**
     * Determine if the user can create a new entity
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create company');
    }

    /**
     * Determine if the user can edit company details.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function update(User $user, Company $company): bool
    {
        return ($user->is_crew
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->can('update company');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Company $company): bool
    {
        return ($user->is_crew
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->can('delete company');
    }

    /**
     * Determine if the user can view the company's approval status
     * @param User $user
     * @param Company $company
     * @return bool
     */
    public function viewRequest(User $user, Company $company): bool
    {
        return ($user->is_crew
                || $user->isMemberOf($company))
            && $user->can('view company request');
    }

    /**
     * Determine if the user can approve the company
     * @param User $user
     * @param Company $company
     * @return bool
     */
    public function approveRequest(User $user, Company $company): bool
    {
        return $user->is_crew && $user->can('update company request');
    }

    /**
     * Determine if the user can view company members.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function viewAnyMember(User $user, Company $company): bool
    {
        // Edge case since the speaker doesn't have a role that I can give permission to
        if ($user->isMemberOf($company) && $user->presenter_of && $company->is_approved) {
            return true;
        }

        return ($user->is_crew
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->hasPermissionTo('viewAny company member');
    }

    /**
     * Determine if the user can edit company members.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function updateMember(User $user, Company $company): bool
    {
        return ($user->is_crew
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->hasPermissionTo('update company member');
    }

    /**
     * Determine if the user can delete company member.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function deleteMember(User $user, Company $company): bool
    {
        return ($user->is_crew
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->hasPermissionTo('delete company member');
    }

    /**
     * Determine if the user can create company invitation.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function createMemberInvitation(User $user, Company $company): bool
    {
        return ($user->is_crew
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->hasPermissionTo('create company member invitation');
    }

    /**
     * Determine if the user can view company invitations.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function viewAnyMemberInvitation(User $user, Company $company): bool
    {
        return ($user->is_crew
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->hasPermissionTo('viewAny company member invitation');
    }

    /**
     * Determine if the user can delete company invitation.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function deleteMemberInvitation(User $user, Company $company): bool
    {
        return ($user->is_crew
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->hasPermissionTo('delete company member invitation');
    }

    /**
     * Determine if the user can request to delete company.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function requestDelete(User $user, Company $company): bool
    {
        return ($user->is_crew
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->hasPermissionTo('create company delete request');
    }

    /**
     * Determine if the user can view company requests.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function viewRequests(User $user, Company $company): bool
    {
        // View if the company member hasn't decided their role
        if ($user->isMemberOf($company) && $user->isDefaultCompanyMember) {
            return true;
        }

        $isCrewOrCompanyMember = $user->is_crew || ($user->isMemberOf($company) && $company->is_approved);

        $hasRequiredPermissions = $user->hasAllPermissions([
                'view booth request',
                'view sponsorship request',
                'view company delete request'
            ]) || $user->hasRole(['booth owner', 'pending booth owner']);

        return $isCrewOrCompanyMember && $hasRequiredPermissions;
    }

    /**
     * Determines whether the user can request a booth
     * @param User $user
     * @param Company $company
     * @return bool
     */
    public function requestBooth(User $user, Company $company): bool
    {
        return $user->isMemberOf($company)
            && !$company->booth
            && ($user->isDefaultCompanyMember() || $user->hasRole(['company representative', 'pending booth owner']))
            && $user->hasPermissionTo('create booth request');
    }

    /**
     * Determine whether the user can request sponsorship
     *
     * @param User $user
     * @param Company $company
     * @return bool
     */
    public function requestSponsorship(User $user, Company $company)
    {
        return $user->isMemberOf($company)
            && $user->hasPermissionTo('create sponsorship request')
            && !$company->sponsorship;
    }

    /**
     * Determines whether the user can join the booth owners
     * @param User $user
     * @param Company $company
     * @return bool
     */
    public function becomeBoothOwner(User $user, Company $company): bool
    {
        return $user->isMemberOf($company)
            && $company->booth
            && $user->hasPermissionTo('create booth request');
    }
}
