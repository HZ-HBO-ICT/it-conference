<?php

namespace App\Livewire\Dashboards\Modals;

use App\Models\Booth;
use App\Models\Company;
use App\Models\Sponsorship;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class RequestBoothModal extends ModalComponent
{
    public Company $company;
    public User $user;
    public string $additionalInformation;
    public bool $requestSent;

    /**
     * Initializes the component
     * @param Company $company
     * @return void
     */
    public function mount(Company $company, User $user) : void
    {
        $this->company = $company;
        $this->user = $user;
        $this->requestSent = (bool)$this->company->booth;
    }

    /**
     * Sends a request for booth
     * @return void
     * @throws AuthorizationException
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
                    'additional_information' => strlen($this->additionalInformation) == 0
                        ? 'No additional demands' : $this->additionalInformation,
                    'company_id' => $this->company->id
                ]
            );

            $this->user->assignRole('booth owner');

            if ($this->user->hasRole('pending booth owner')) {
                $this->user->removeRole('pending booth owner');
            }

            $this->additionalInformation = '';
            $this->requestSent = true;
            $this->company->refresh();
            $this->dispatch('updated-dashboard');
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
