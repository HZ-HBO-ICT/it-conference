<?php

namespace App\Http\Controllers\Crew;

use App\Events\FinalProgrammeReleased;
use App\Http\Controllers\Controller;
use App\Models\DefaultPresentation;
use App\Models\Edition;
use App\Models\Event;
use App\Models\Presentation;
use App\Models\Timeslot;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * Returns the page with general management overview of the schedule
     *
     * @return View
     */
    public function index(): View
    {
        $noActiveEdition = is_null(Edition::current());

        return view('crew.schedule.index', compact(['noActiveEdition']));
    }

    /**
     * Responsible for resetting the schedule based on the type
     * $type == 'full' - removing all scheduling from the presentation; removing the timeslots and the opening/closing
     * $type == 'scheduled' - removing all scheduling from the presentation
     *
     * @param $type
     * @return mixed
     */
    public function reset($type)
    {
        Presentation::query()->update([
            'room_id' => null,
            'timeslot_id' => null,
            'start' => null
        ]);

        if ($type == 'full') {
            DefaultPresentation::truncate();

            // Truncate does not work when model is FK
            foreach (Timeslot::all() as $timeslot) {
                $timeslot->delete();
            }
        }

        return redirect(route('moderator.schedule.index'))
            ->banner('You reset the schedule successfully.');
    }

    /**
     * Changes the state of the edition to enrollment
     *
     * @return void
     */
    public function publishFinalProgramme()
    {
        $readyForRelease = Presentation::all()->every(function ($presentation) {
            return $presentation->isScheduled && $presentation->is_approved;
        });

        if (!$readyForRelease) {
            return redirect(route('moderator.schedule.index'))
                ->banner('Seems like the programme cannot be released yet. Check the status of the presentation');
        }


        FinalProgrammeReleased::dispatch();

        return redirect(route('moderator.schedule.index'))
            ->banner('The programme was published successfully! Participants now can enroll in the presentations');
    }
}
