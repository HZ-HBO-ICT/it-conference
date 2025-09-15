<?php

namespace App\Livewire\QrCode;

use App\Models\Presentation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class ManualFormModal extends ModalComponent
{
    public Room $room;
    public Presentation $presentation;
    public User $selectedUser;
    public Collection $users;
    public Collection $defaultUsers;
    public Collection $presentations;
    public string $searchValue;
    public bool $isDropdownVisible;

    /**
     * Initialize the modal
     *
     * @param int|null $roomId
     *
     * @return void
     */
    public function mount(?int $roomId = null): void
    {
        if ($roomId) {
            $this->room = Room::find($roomId);
        }

        $this->searchValue = '';
        $this->defaultUsers = User::role('participant')
            ->get()
            ->filter(function ($user) {
                return $user->hasExactRoles('participant');
            });
        $this->users = $this->defaultUsers;
        $this->isDropdownVisible = false;
    }

    /**
     * Update search result if the email/name is being changed
     *
     * @return void
     */
    public function updateSearchResult(): void
    {
        $this->users = $this->defaultUsers;
        if (!empty($this->searchValue)) {
            $this->users = $this->users->filter(function ($user) {
                $nameMatch = stripos($user->name, $this->searchValue) !== false;
                $emailMatch = stripos($user->email, $this->searchValue) !== false;

                return $nameMatch || $emailMatch;
            });
        }
    }

    /**
     * Triggered when the user chooses the assignee
     *
     * @param $id
     *
     * @return void
     */
    public function selectUser($id): void
    {
        $this->selectedUser = User::find($id);
        $this->searchValue = $this->selectedUser->name;
        $this->updateSearchResult();
        $this->isDropdownVisible = false;

        $this->presentations = $this->selectedUser->participating_in;
    }

    /**
     * Responsible for the visibility status of the dropdown
     *
     * @return void
     */
    public function toggleDropdown(): void
    {
        $this->isDropdownVisible = !$this->isDropdownVisible;
    }

    /**
     * Render the modal
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.qr-code.manual-form-modal');
    }
}
