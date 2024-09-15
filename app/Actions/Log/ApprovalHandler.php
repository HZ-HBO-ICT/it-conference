<?php

namespace App\Actions\Log;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ApprovalHandler
{
    public function execute($entity, $isApproved, $field='is_approved')
    {
        $status = $isApproved ? 'approved' : 'rejected';

        $entity->disableLogging();

        $logMessage = '';
        if($field != 'is_approved') {
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

        if ($isApproved) {
            $entity->$field = true;
            $entity->save();
        } elseif($field == 'is_approved') {
            $entity->delete();

            if ($entity instanceof Company) {
                $this->handleAdditionalCompanyRejection($entity);
            }
        }

        $entity->enableLogging();
    }

    private function handleAdditionalCompanyRejection($company)
    {
        $participantRole = Role::findByName('participant', 'web');
        foreach ($company->users as $user) {
            $user->syncRoles($participantRole);
        }
    }
}
