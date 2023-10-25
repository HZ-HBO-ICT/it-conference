<?php

namespace App\Http\Livewire\DefaultPresentations;

use App\Http\Controllers\TimeslotController;
use App\Models\DefaultPresentation;
use App\Models\Presentation;
use App\Models\Timeslot;
use Carbon\Carbon;
use Livewire\Component;

class EditDefaultPresentationForm extends Component
{
    public DefaultPresentation $presentation;

    public $starting;
    public $ending;

    public $confirmingOpeningChangeTime;

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

    public function save()
    {
        $this->validate();

        $this->precheckSaveOpening();
    }

    public function precheckSaveOpening()
    {
        $closestTimeslot = $this->presentation->timeslot->closestTo();

        if (Carbon::parse($this->ending)->gt(Carbon::parse($closestTimeslot->start))) {
            $this->confirmingOpeningChangeTime = true;
        } else {
            $this->validate();

            $this->presentation->timeslot->start = $this->starting;

            $this->presentation->timeslot->duration = Carbon::parse($this->ending)
                ->diffInMinutes(Carbon::parse($this->starting));

            $this->presentation->timeslot->save();

            $this->presentation->save();

            return redirect()->to(route('moderator.schedule.overview'));
        }
    }

    public function confirmedSaveOpening()
    {
        $this->validate();
        $timeslotIdsToDelete = [];

        foreach (Presentation::all() as $presentation) {
            $timeslotIdsToDelete[] = $presentation->timeslot_id;

            $presentation->timeslot_id = null;
            $presentation->room_id = null;

            $presentation->save();
        }
        Timeslot::whereIn('id', $timeslotIdsToDelete)->delete();

        $newTimeslotDuration = Carbon::parse($this->ending)
            ->diffInMinutes(Carbon::parse($this->starting));

        $newTimeslot = Timeslot::create([
            'start' => $this->starting,
            'duration' => $newTimeslotDuration
        ]);

        $oldTimeslot = $this->presentation->timeslot;
        $this->presentation->timeslot_id = $newTimeslot->id;
        $this->presentation->save();

        $oldTimeslot->delete();

        $startTimeOfNewTimeslots = Carbon::parse(
            DefaultPresentation::opening()->timeslot->start)
            ->addMinutes(DefaultPresentation::opening()->timeslot->duration)
            ->format("H:i");
        $endingTimeOfNewTimeslots = DefaultPresentation::closing()->timeslot->start;

        TimeslotController::generate($startTimeOfNewTimeslots, $endingTimeOfNewTimeslots);

        return redirect()->to(route('moderator.schedule.overview'));
    }

    public function render()
    {
        return view('moderator.schedule.default-presentations.edit-default-presentation-form');
    }
}
