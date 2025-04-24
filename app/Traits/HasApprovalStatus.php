<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use App\Enums\ApprovalStatus;

/**
 * Trait HasApprovalStatus.
 * This trait provides methods that make the usage of the `ApprovalStatus` enum easier
 *
 * @mixin Model
 */
trait HasApprovalStatus
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

    /**
     * Scope a query to only include models with a specific status.
     *
     * @param Builder<Model> $query
     * @param ApprovalStatus|string $status
     * @return Builder<Model>
     */
    public function scopeHasStatus(Builder $query, ApprovalStatus|string $status): Builder
    {
        $statusValue = $status instanceof ApprovalStatus ? $status->value : $status;
        return $query->where('status', $statusValue);
    }

    /**
     * Scope a query to only include models with a specific sponsorship status.
     *
     * @param Builder<Model> $query
     * @param ApprovalStatus|string $status
     * @return Builder<Model>
     */
    public function scopeHasSponsorshipStatus(Builder $query, ApprovalStatus|string $status): Builder
    {
        $statusValue = $status instanceof ApprovalStatus ? $status->value : $status;
        return $query->where('sponsorship_status', $statusValue);
    }

    /**
     * Scope a query to order models so that records with the given status appear first.
     * Limited to a single status. If you require more than one create a local function for it.
     *
     * @param Builder<static> $query
     * @param string|ApprovalStatus $approvalStatus
     * @param string $fieldName The attribute name to check.
     * @return Builder<static>
     */
    public function scopeOrderByPriorityStatus(
        Builder $query,
        ApprovalStatus|string $approvalStatus,
        string $fieldName = 'approval_status'
    ): Builder {
        $statusValue = $approvalStatus instanceof ApprovalStatus
            ? $approvalStatus->value
            : $approvalStatus;
            
        return $query->orderByRaw("{$fieldName} != ?", [$statusValue]);
    }

    /**
     * Derived attribute that allows us to still use `is_approved` and minimize the
     * refactoring from the new field
     * @return Attribute<bool, never>
     */
    public function isApproved() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->approval_status == ApprovalStatus::APPROVED->value,
        );
    }
}
