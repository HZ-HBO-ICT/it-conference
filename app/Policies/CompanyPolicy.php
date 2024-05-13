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
        return $user->can('view company list');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Company $company): bool
    {
        return ($user->is_backend_user || $user->isMemberOf($company))
            && $user->can('view company details');
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
        return ($user->is_backend_user
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->can('edit company details');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Company $company): bool
    {
        return ($user->is_backend_user
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
        return ($user->is_backend_user
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
        return $user->is_backend_user && $user->can('edit company request');
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
        return ($user->is_backend_user
            || $user->isMemberOf($company) && $company->is_approved)
                && $user->can('viewAny company member');
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
        return ($user->is_backend_user
            || $user->isMemberOf($company) && $company->is_approved)
                && $user->can('update company member');
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
        return ($user->is_backend_user
            || $user->isMemberOf($company) && $company->is_approved)
                && $user->can('delete company member');
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
        return ($user->is_backend_user
                || $user->isMemberOf($company) && $company->is_approved)
            && $user->can('create company member invitation');
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
        return ($user->is_backend_user
            || $user->isMemberOf($company) && $company->is_approved)
                && $user->can('viewAny company member invitation');
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
        return ($user->is_backend_user
            || $user->isMemberOf($company) && $company->is_approved)
                && $user->can('delete company member invitation');
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
        return ($user->is_backend_user
            || $user->isMemberOf($company) && $company->is_approved)
                && $user->can('create company delete request');
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
        return ($user->is_backend_user
            || $user->isMemberOf($company) && $company->is_approved)
                && $user->can(['view booth request', 'view sponsorship request', 'view company delete request']);
    }
}
