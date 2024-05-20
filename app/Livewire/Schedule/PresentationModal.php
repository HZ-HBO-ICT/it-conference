<?php

namespace App\Livewire\Schedule;

use App\Actions\Schedule\PresentationAllocationHelper;
use App\Actions\Schedule\PresentationConflictChecker;
use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use LivewireUI\Modal\ModalComponent;

class PresentationModal extends ModalComponent
{
    public $presentation;
    public $rooms;

    #[Validate(['required', 'exists:rooms,id'])]
    public $room_id;

    #[Validate(['required', 'date_format:H:i'])]
    public $start;

    public $errorMessage;

    /**
     * Initializes the component
     * @param $presentation
     * @return void
     */
    public function mount($presentationId)
    {
        $this->presentation = \App\Models\Presentation::find($presentationId);
        $this->rooms = Room::all();

        $this->room_id = $this->presentation->room->id;
        $this->start = Carbon::parse($this->presentation->start)->format('H:i');
    }

    public function save()
    {
        $this->validate();
        $this->additionalStartTimeValidation($this->start);

        $presentationChecker = new PresentationConflictChecker();
        $allocationHelper = new PresentationAllocationHelper();

        $timeslot = $allocationHelper->findTimeslotByStartingTime($this->start);
        $room = Room::find($this->room_id);

        if ($presentationChecker->isClearOfConflicts($this->presentation, $room, $this->start)) {
            $this->dispatch('move-presentation', data: [
                'presentation_id' => $this->presentation->id,
                'new_room_id' => $this->room_id,
                'new_timeslot_id' => $timeslot->id,
                'new_time' => $this->start
            ]);

            $this->closeModal();
        } else {
            $this->errorMessage = 'Error: Scheduling conflict has occurred and the presentation cannot
                be moved to the desired spot. Try to set different starting time';
        }
    }

    public function additionalStartTimeValidation($start)
    {
        $validator = Validator::make(
            ['start' => $this->start],
            ['start' => ['required', 'date_format:H:i', function ($attribute, $value, $fail) {
                $start = Carbon::parse($value);
                $startHour = $start->hour;

                if ($startHour < 8 || $startHour >= 18) {
                    $fail('The starting time must be after 8 AM and before 6 PM.');
                }
            }]]
        );

        $validator->validate();
    }

    public function render()
    {
        return view('livewire.schedule.presentation-modal');
    }
}
