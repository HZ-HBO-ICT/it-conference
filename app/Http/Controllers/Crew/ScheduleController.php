<?php

namespace App\Http\Controllers\Crew;

use App\Actions\Schedule\ResetSchedule;
use App\Events\FinalProgrammeReleased;
use App\Http\Controllers\Controller;
use App\Mail\FinalProgrammeReleasedMailable;
use App\Models\DefaultPresentation;
use App\Models\Edition;
use App\Models\Presentation;
use App\Models\Timeslot;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
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
        if (!Gate::authorize('view-schedule')) {
            abort(403);
        }

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
        if (!Gate::authorize('edit-schedule')) {
            abort(403);
        }

        ResetSchedule::reset($type);

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
        if (!Gate::authorize('edit-schedule')) {
            abort(403);
        }

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
