<?php

namespace App\Livewire\Booth;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class JoinBoothOwnerModal extends ModalComponent
{
    /**
     * Assigns the booth owner role to the user
     */
    public function save()
    {
        $this->authorize('becomeBoothOwner', Auth::user()->company);
        Auth::user()->assignRole('booth owner');
        Auth::user()->removeRole('pending booth owner');

        return redirect(route('dashboard'))
            ->with('status', 'You successfully became a booth owner.');
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.booth.join-booth-owner-modal');
    }
}
