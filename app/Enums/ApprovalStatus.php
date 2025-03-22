<?php

namespace App\Enums;

enum ApprovalStatus: string
{
    case AWAITING_APPROVAL = 'awaiting_approval';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case FEEDBACK_GIVEN = 'feedback_given';
    case NOT_REQUESTED = 'not_requested';
}
