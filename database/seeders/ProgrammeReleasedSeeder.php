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

            $opening = DefaultPresentation::create([
                'name' => 'Opening presentation',
                'description' => 'This is the opening presentation!',
                'start' => '08:00:00',
                'end' => '9:30:00',
                'type' => 'opening',
                'room_id' => '1',
            ]);

            $closing = DefaultPresentation::create([
                'name' => 'Closing presentation',
                'description' => 'This is the closing presentation!',
                'start' => '16:00:00',
                'end' => '17:30:00',
                'type' => 'closing',
                'room_id' => '1',
            ]);

            Timeslot::generateTimeslots();

            Presentation::all()->each(function (Presentation $presentation) {
               $presentation->update(['approval_status' => ApprovalStatus::APPROVED->value]);
            });

            $timezone = new DateTimeZone('Europe/Amsterdam');
            $currentTime = new DateTime($opening->end, $timezone);
            $closingTime = new DateTime($closing->start, $timezone);
            $room_id = 1;
            $helper = new PresentationAllocationHelper();

            $edition = Edition::current();
            $lecture_duration = $edition->lecture_duration ?? 30;
            $workshop_duration = $edition->workshop_duration ?? 120;

            foreach (Presentation::all() as $presentation) {
                $timeslot = $helper->findTimeslotByStartingTime($currentTime);

                $presentation->update([
                    'room_id' => $room_id,
                    'timeslot_id' => $timeslot->id,
                    'start' => $currentTime->format('H:i'),
                ]);

                if ($presentation->type == 'lecture') {
                    $currentTime->modify("+{$lecture_duration} minutes");
                } else {
                    $currentTime->modify("+{$workshop_duration} minutes");
                }

                if ($room_id == Room::count()) {
                  break;
                } else if ($currentTime >= $closingTime) {
                    $room_id += 1;
                    $currentTime = new DateTime($opening->end, $timezone);
                }
            }

            FinalProgrammeReleased::dispatch();
        });
    }
}
