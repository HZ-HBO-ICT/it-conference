<?php

namespace App\Http\Livewire\DefaultPresentations;

use App\Http\Controllers\TimeslotController;
use App\Models\DefaultPresentation;
use App\Models\Presentation;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Component;

class EditDefaultPresentationForm extends Component
{
    public DefaultPresentation $presentation;

    public $starting;
    public $ending;

    public $confirmationTimeslotRegeneration;

    /**
     * After the component is instantiated set the starting and ending separately from the model
     */
    public function mount()
    {
        $this->starting = Carbon::parse($this->presentation->timeslot->start);
        $this->ending = Carbon::parse($this->presentation->timeslot->start)
            ->addMinutes($this->presentation->timeslot->duration)->format('H:i');
        $this->starting = $this->starting->format('H:i');
    }

    protected $rules = [
        'presentation.name' => 'required',
        'presentation.description' => 'required',
        'presentation.room_id' => 'required|numeric',
        'starting' => 'required|date_format:H:i',
        'ending' => 'required|date_format:H:i|after:starting'
    ];

    /**
     * Triggered by the save button, based on the default presentation type calls
     * different checks
     */
    public function save()
    {
        $this->validate();

        if ($this->presentation->type == 'opening') {
            $this->checkSaveOpening();
        } else {
            $this->checkSaveClosing();
        }
    }

    /**
     * Checks if the ending time of the opening presentation overlaps the generated timeslots and
     * if it does, it opens another modal to confirm their regeneration, while if it doesn't it calls
     * a method that saves the changes of the opening presentation
     */
    public function checkSaveOpening()
    {
        $closestTimeslot = $this->presentation->timeslot->closestStartingTimeslot();

        if (Carbon::parse($this->ending)->gt(Carbon::parse($closestTimeslot->start))) {
            $this->confirmationTimeslotRegeneration = true;
        } else {
            $this->saveChanges();
            return redirect()->to(route('moderator.schedule.overview'));
        }
    }

    /**
     * Checks if the starting time of the closing presentation overlaps the generated timeslots and
     * if it does, it opens another modal to confirm their regeneration, while if it doesn't it calls
     * a method that saves the changes of the closing presentation
     */
    public function checkSaveClosing()
    {
        $latestEndingTime = Timeslot::getTheLatestEndingUsed();

        if (Carbon::parse($this->starting)
            ->lt(Carbon::parse($latestEndingTime))) {
            $this->confirmationTimeslotRegeneration = true;
        } else {
            $this->saveChanges();
            return redirect()->to(route('moderator.schedule.overview'));
        }
    }

    /**
     * Regenerates all timeslots
     */
    public function confirmedTimeslotRegeneration()
    {
        $this->saveChanges();

        $timeslotPadding = Timeslot::paddingBetweenSlots();

        foreach (Presentation::all() as $presentation) {
            $presentation->timeslot_id = null;
            $presentation->room_id = null;

            $presentation->save();
        }

        Timeslot::where(function ($query) {
            $query->where('id', '!=', DefaultPresentation::opening()->timeslot_id)
                ->where('id', '!=', DefaultPresentation::closing()->timeslot_id);
        })->delete();

        $startTimeOfNewTimeslots = Carbon::parse(DefaultPresentation::opening()->timeslot->start)
            ->addMinutes(DefaultPresentation::opening()->timeslot->duration)
            ->format("H:i");
        $endingTimeOfNewTimeslots = DefaultPresentation::closing()->timeslot->start;

        TimeslotController::generate($startTimeOfNewTimeslots, $endingTimeOfNewTimeslots, $timeslotPadding);

        return redirect()->to(route('moderator.schedule.overview'));
    }

    /**
     * Saves the changes on the presentation
     */
    public function saveChanges()
    {
        $this->validate();

        $this->presentation->timeslot->start = $this->starting;

        $this->presentation->timeslot->duration = Carbon::parse($this->ending)
            ->diffInMinutes(Carbon::parse($this->starting));

        $this->presentation->timeslot->save();

        $this->presentation->save();
    }

    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('moderator.schedule.default-presentations.edit-default-presentation-form');
    }
}
