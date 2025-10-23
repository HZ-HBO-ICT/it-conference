<?php

namespace App\Actions\Ticket;

use App\Models\Presentation;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;

class TicketHandler
{
    /**
     * Get the closest presentation from user's enrolled presentations for a given room.
     *
     * @param Room $room
     * @param User $user
     *
     * @return Presentation
     */
    public function getClosestPresentation(Room $room, User $user): Presentation
    {
        return $user->participating_in->filter(function ($enrolledPresentation) use ($room) {
            if ($enrolledPresentation->room_id !== $room->id) {
                return false;
            }

            $now = Carbon::now();
            $startTime = Carbon::parse($enrolledPresentation->start);

            return $now->betweenIncluded($startTime->copy()->subMinutes(15), $startTime) ||
                $now->betweenIncluded($startTime, $startTime->copy()->addMinutes($enrolledPresentation->duration / 2));
        })->firstOrFail();
    }
}
