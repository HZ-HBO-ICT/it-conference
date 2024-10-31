<?php

namespace App\Policies;

use App\Models\User;

class TicketPolicy
{
    /**
     * Determine whether the user can scan any tickets.
     */
    public function scan(User $user): bool
    {
        return $user->can('scan ticket');
    }
}
