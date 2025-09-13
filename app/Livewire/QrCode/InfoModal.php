<?php

namespace App\Livewire\QrCode;

use App\Models\Presentation;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserPresentation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class InfoModal extends ModalComponent
{
    public User $user;
    public Presentation $presentation;
    public string $message = 'Attendance confirmed';

    /**
     * Initialize the modal
     *
     * @param array $data
     * @return void
     */
    public function mount(array $data): void
    {
        if (!isset($data['id']) || !isset($data['token'])) {
            return;
        }

        try {
            $now = Carbon::now();
            $user = User::findOrFail($data['id']);

            $ticket = Ticket::where([
                'user_id' => $user->id,
                'token' => $data['token']
            ])->firstOrFail();

            if (isset($data['room'])) {
                $room = Room::findOrFail($data['room']);

                $presentation = $user->participating_in->filter(function ($enrolledPresentation) use ($now, $room) {
                    if ($enrolledPresentation->room_id !== $room->id) {
                        return false;
                    }

                    $startTime = Carbon::parse($enrolledPresentation->start);

                    return $now->betweenIncluded($startTime->copy()->subMinutes(15), $startTime) ||
                        $now->betweenIncluded($startTime, $startTime->copy()->addMinutes($enrolledPresentation->duration / 2));
                })->firstOrFail();

                $userPresentation = UserPresentation::where([
                    'user_id' => $user->id,
                    'presentation_id' => $presentation->id,
                ])->firstOrFail();

                if (!$userPresentation->attended) {
                    $userPresentation->attended = true;
                    $userPresentation->save();
                }

                $this->presentation = $presentation;
            }

            $ticket->scanned_at = $now;
            $ticket->save();

            $this->user = $user;
        } catch (ModelNotFoundException | ItemNotFoundException) {
            $this->message = 'Ticket could not be processed';
            return;
        }
    }

    /**
     * Sets the maximum width of the modal according to docs
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    /**
     * Render the modal
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.qr-code.info-modal');
    }
}
