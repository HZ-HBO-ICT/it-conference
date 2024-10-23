<?php

namespace App\Livewire\QrCode;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class InfoModal extends ModalComponent
{
    public User $user;
    public string $message;
    public string $color;

    /**
     * Initialize the modal
     *
     * @param array $data
     * @return void
     */
    public function mount(array $data): void
    {
        if (!isset($data['id']) || !isset($data['token'])) {
            $this->message = 'Invalid data';
            $this->color = 'red';

            return;
        }

        $this->user = User::find($data['id']);

        $ticket = Ticket::where([
            'user_id' => $data['id'],
            'token' => $data['token']
        ])->first();

        if ($this->isTicketValid($ticket)) {
            $this->message = 'Success';
            $this->color = 'green';

            $ticket->scanned_at = now();
            $ticket->save();
        } else {
            $this->color = 'red';
        }
    }

    /**
     * Determine whether the given ticket is valid
     *
     * @param Ticket $ticket
     * @return bool
     */
    public function isTicketValid(Ticket $ticket): bool
    {
        if (!$this->user->id) {
            $this->message = 'Person does not exist';
            return false;
        }

        if (!$ticket->id) {
            $this->message = 'Ticket does not exist';
            return false;
        }

        if ($ticket->scanned_at) {
            $this->message = 'Ticket was already scanned';
            return false;
        }

        return true;
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
