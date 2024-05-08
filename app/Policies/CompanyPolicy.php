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
     * Determine if the user can create a new entity
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create company');
    }

    /**
     * Determine if the user can view the company's approval status
     * @param User $user
     * @param Company $company
     * @return bool
     */
    public function viewApprovalStatus(User $user, Company $company): bool
    {
        return $user->can('view company approval status');
    }

    /**
     * Determine if the user can approve the company
     * @param User $user
     * @param Company $company
     * @return bool
     */
    public function approve(User $user, Company $company): bool
    {
        return $user->can('edit company approval status');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Company $company): bool
    {
        return $user->can('delete company');
    }

    /**
     * Determine if the user can view company details.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function viewDetails(User $user, Company $company): bool
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('view company details')
                && $company->is_approved;
        } elseif ($user->can('view company details')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can edit company details.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function editDetails(User $user, Company $company): bool
    {

        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('edit company details')
                && $company->is_approved;
        } elseif ($user->can('edit company details')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can view company members.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function viewMembers(User $user, Company $company): bool
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('view company members')
                && $company->is_approved;
        }

        return false;
    }

    /**
     * Determine if the user can edit company members.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @param User $toBeEdited
     * @return bool
     */
    public function editMember(User $user, Company $company, User $toBeEdited): bool
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->id != $toBeEdited->id
                && $user->can('edit company members')
                && $company->is_approved;
        }

        return false;
    }

    /**
     * Determine if the user can delete company member.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @param User $toBeDeleted
     * @return bool
     */
    public function deleteMember(User $user, Company $company, User $toBeDeleted): bool
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->id != $toBeDeleted->id
                && $user->can('delete company members')
                && $company->is_approved;
        }

        return false;
    }

    /**
     * Determine if the user can view company invitations.
     *
     * @param User $user The user instance.
     * @param Company $company The company instance.
     * @return bool
     */
    public function viewMemberInvitations(User $user, Company $company): bool
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('view member invitations')
                && $company->is_approved;
        }

        return false;
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
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('create member invitation')
                && $company->is_approved;
        }

        return false;
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
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('delete member invitation')
                && $company->is_approved;
        }

        return false;
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
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('request company delete')
                && $company->is_approved;
        }

        return false;
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
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can(['create booth request', 'create sponsorship request'])
                && $company->is_approved;
        }

        return false;
    }
}
