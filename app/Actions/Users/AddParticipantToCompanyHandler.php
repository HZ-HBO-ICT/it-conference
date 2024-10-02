<?php

namespace App\Actions\Users;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Spatie\Permission\Models\Role;

class AddParticipantToCompanyHandler
{
    /**
     * Handles the adding of a user who registered as a participant to
     * their company. The default role is company member, which is going to be assigned unless
     * the user has a presentation or another role is passed
     *
     * @param User $user
     * @param Company $company
     * @param string $role
     * @return void
     */
    public function execute(User $user, Company $company, string $role = 'company member'): void
    {
        // Making sure, if something fails, everything will roll back
        DB::transaction(function () use ($user, $company, $role) {
            if ($user->company) {
                throw new Exception('The user is already a member of a company. Are you sure this is the right user?');
            }

            $user->update([
                'company_id' => $company->id
            ]);

            if ($user->presenter_of) {
                if (!$company->has_presentations_left) {
                    throw new Exception('The company has reached their presentation limit. Contact them to resolve this.');
                }

                $presentation = $user->presenter_of;
                $presentation->update([
                    'company_id' => $company->id
                ]);
            } else {
                if (!Role::findByName($role, 'web')) {
                    throw new Exception('The role cannot be found');
                }

                $role = Role::findByName($role, 'web');
                $user->assignRole($role);
            }
        });
    }
}
