<?php

namespace App\Livewire\Sponsorship;

use App\Models\Company;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteSponsorshipModal extends ModalComponent
{
    public Company $company;

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.sponsorship.delete-sponsorship-modal');
    }
}
