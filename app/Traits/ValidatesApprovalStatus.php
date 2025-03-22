<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use App\Enums\ApprovalStatus;

/**
 * Trait ValidatesApprovalStatus.
 * This trait provides a method to validate the "approval_status" attribute based
 * on the available values in the ApprovalStatus Enum
 *
 * @mixin Model
 */
trait ValidatesApprovalStatus
{
    /**
     * Validate the approval status of the model.
     * @param string $fieldName The field that should be validated
     * @return void
     * @throws InvalidArgumentException if the approval status is invalid.
     */
    public function validateApprovalStatus(string $fieldName = 'approval_status'): void
    {
        if ($this->isDirty($fieldName)) {
            $newStatus = $this->{$fieldName};
            if (!ApprovalStatus::tryFrom($newStatus)) {
                throw new InvalidArgumentException(
                    sprintf('Invalid approval status: %s', $newStatus)
                );
            }
        }
    }
}
