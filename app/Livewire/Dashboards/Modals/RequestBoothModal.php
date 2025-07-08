<?php

namespace App\Livewire\Dashboards\Modals;

use App\Models\Booth;
use App\Models\Company;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class RequestBoothModal extends ModalComponent
{
    public Company $company;
    public $additionalInformation;
    public $requestSent;

    /**
     * Initializes the component
     * @param Company $company
     * @return void
     */
    public function mount(Company $company) : void
    {
        $this->company = $company;
        $this->requestSent = (bool)$this->company->booth;
    }

    /**
     * Sends a request for booth
     * @return void
     */
    public function requestBooth()
    {
        $this->authorize('createRequest', Booth::class);

        $this->validate([
            'additionalInformation' => 'nullable|max:255',
        ]);

        if (!$this->company->booth) {
            Booth::create(
                [
                    'width' => 1,
                    'length' => 2,
                    'additional_information' => is_null($this->additionalInformation)
                        ? 'No additional demands' : $this->additionalInformation,
                    'company_id' => $this->company->id
                ]
            );

            Auth::user()->assignRole('booth owner');

            if (Auth::user()->hasRole('pending booth owner')) {
                Auth::user()->removeRole('pending booth owner');
            }

            $this->additionalInformation = '';
            $this->requestSent = true;
            $this->company->refresh();
            Toaster::success('Booth was successfully requested.');
        }
    }

    /**
     * Close the modal
     * @return void
     */
    public function cancel() : void
    {
        $this->closeModal();
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.modals.request-booth-modal');
    }
}
