<?php

namespace App\Actions\Log;

use App\Enums\ApprovalStatus;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ApprovalHandler
{
    /**
     * Handles the approval or rejection of the entities
     * s
     * @param $entity
     * @param $isApproved
     * @param $field
     * @return void
     * @throws \ReflectionException
     */
    public function execute($entity, $isApproved, $field = 'approval_status')
    {
        $status = $isApproved ? ApprovalStatus::APPROVED->value : ApprovalStatus::REJECTED->value;

        $entity->disableLogging();

        $logMessage = '';
        if ($field != 'approval_status') {
            $logMessage = $entity->name . "'s sponsorship has been {$status} by " . Auth::user()->name;
        } else {
            $entityType = (new \ReflectionClass($entity))->getShortName();
            $entityName = $entity->name ?? $entity->company->name;
            $logMessage = "{$entityType} {$entityName} has been {$status} by " . Auth::user()->name;
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($entity)
            ->event($status)
            ->log($logMessage);

        if ($isApproved == ApprovalStatus::APPROVED->value) {
            $entity->$field = $status;
            $entity->save();
        } elseif ($field == 'approval_status') {
            // TODO: Determine better "rejection" scenario
            $entity->delete();

            if ($entity instanceof Company) {
                $this->handleAdditionalCompanyRejection($entity);
            }
        }

        $entity->enableLogging();
    }

    /**
     * Helper method taking care of the additional company rejection
     *
     * @param $company
     * @return void
     */
    private function handleAdditionalCompanyRejection($company)
    {
        $participantRole = Role::findByName('participant', 'web');
        foreach ($company->users as $user) {
            $user->syncRoles($participantRole);
        }
    }
}
