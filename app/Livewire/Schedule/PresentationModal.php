<?php

namespace App\Livewire\Schedule;

use App\Actions\Schedule\PresentationAllocationHelper;
use App\Actions\Schedule\PresentationConflictChecker;
use App\Mail\CancelledPresentationMailable;
use App\Models\Edition;
use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
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

    /**
     * Processes the new data submitted by the user and sends move event to the parent
     * to handle the moving of presentation
     * @return void
     */
    public function save()
    {
        $this->authorize('edit-schedule');

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

    /**
     * Ensures that the time given is between the starting time of the conference day and before the end
     * @param $start
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
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

    /**
     * Handles removing of participant of presentation if needed and sends an
     * event to the parent to handle removing of the presentation from the schedule
     *
     * @return void
     */
    public function remove()
    {
        if (Edition::current()->is_final_programme_released) {
            $participants = $this->presentation->participants;
            foreach ($participants as $participant) {
                $participant->leavePresentation($this->presentation);

                if ($participant->receive_emails) {
                    Mail::to($participant->email)->send(new CancelledPresentationMailable($participant, $this->presentation));
                }
            }
        }

        $this->dispatch('remove-presentation', data: [
            'presentation_id' => $this->presentation->id
        ]);

        $this->closeModal();
    }

    /**
     * Renders the component
     * @return View
     */
    public function render(): View
    {
        return view('livewire.schedule.presentation-modal');
    }
}
