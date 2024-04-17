<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    public function viewDetails(User $user, Company $company)
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('view company details')
                && $company->is_approved;
        }

        return false;
    }

    public function editDetails(User $user, Company $company)
    {

        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('edit company details')
                && $company->is_approved;
        }

        return false;
    }

    public function viewMembers(User $user, Company $company)
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('view company members')
                && $company->is_approved;
        }

        return false;
    }

    public function editMember(User $user, Company $company, User $toBeEditted)
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->id != $toBeEditted->id
                && $user->can('edit company members')
                && $company->is_approved;
        }

        return false;
    }

    public function deleteMember(User $user, Company $company, User $toBeDeleted)
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->id != $toBeDeleted->id
                && $user->can('delete company members')
                && $company->is_approved;
        }

        return false;
    }

    public function viewMemberInvitations(User $user, Company $company)
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('view member invitations')
                && $company->is_approved;
        }

        return false;
    }

    public function createMemberInvitation(User $user, Company $company)
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('create member invitation')
                && $company->is_approved;
        }

        return false;
    }

    public function deleteMemberInvitation(User $user, Company $company)
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('delete member invitation')
                && $company->is_approved;
        }

        return false;
    }

    public function requestDelete(User $user, Company $company)
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can('request company delete')
                && $company->is_approved;
        }

        return false;
    }

    public function viewRequests(User $user, Company $company)
    {
        if ($user->company) {
            return $user->company->id == $company->id
                && $user->can(['create booth request', 'create sponsorship request'])
                && $company->is_approved;
        }

        return false;
    }
}
