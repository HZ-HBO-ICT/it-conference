<?php

namespace App\Enums;

enum ApprovalStatus: string
{
    case AWAITING_APPROVAL = 'awaiting_approval';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case FEEDBACK_GIVEN = 'feedback_given';
    case NOT_REQUESTED = 'not_requested';

    /**
     * Determines the colour
     * @param string $value
     * @return string
     */
    public static function colorFromValue(string $value): string
    {
        return match ($value) {
            self::AWAITING_APPROVAL->value => 'yellow',
            self::APPROVED->value => 'green',
            self::REJECTED->value => 'red',
            self::FEEDBACK_GIVEN->value => 'blue',
            self::NOT_REQUESTED->value => 'gray',
            default => 'gray',
        };
    }
}
