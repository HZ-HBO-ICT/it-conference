<?php

namespace Database\Seeders;

use App\Actions\Schedule\PresentationAllocationHelper;
use App\Enums\ApprovalStatus;
use App\Events\FinalProgrammeReleased;
use App\Models\DefaultPresentation;
use App\Models\Edition;
use App\Models\Presentation;
use App\Models\Room;
use App\Models\Timeslot;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Seeder;

class ProgrammeReleasedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        activity()->withoutLogs(function () {
            $this->call(ParticipantRegistrationSeeder::class);

            $opening = optional(DefaultPresentation::opening());
            $closing = optional(DefaultPresentation::closing());

            Presentation::all()->each(function (Presentation $presentation) {
                $presentation->update(['approval_status' => ApprovalStatus::APPROVED->value]);
            });

            $timezone = new DateTimeZone('Europe/Amsterdam');
            $currentTime = new DateTime($opening->end, $timezone);
            $closingTime = new DateTime($closing->start, $timezone);
            $room_id = 1;
            $helper = new PresentationAllocationHelper();

            foreach (Presentation::all() as $presentation) {
                $timeslot = $helper->findTimeslotByStartingTime($currentTime);

                $presentation->update([
                    'room_id' => $room_id,
                    'timeslot_id' => $timeslot->id,
                    'start' => $currentTime->format('H:i'),
                ]);

                $currentTime->modify("+{$presentation->presentationType->duration} minutes");

                if ($room_id == Room::count()) {
                    break;
                } elseif ($currentTime >= $closingTime) {
                    $room_id += 1;
                    $currentTime = new DateTime($opening->end, $timezone);
                }
            }

            FinalProgrammeReleased::dispatch();
        });
    }
}
