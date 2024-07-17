<?php

namespace App\Livewire\Company;

use App\Models\Booth;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BoothRequest extends Component
{
    public $company;
    public $additionalInformation;
    public $requestSent;

    /**
     * Initializing the component
     * @param $company
     * @return void
     */
    public function mount($company)
    {
        $this->company = $company;

        $this->requestSent = $this->company->booth ? true : false;
    }

    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('livewire.company.booth-request');
    }

    /**
     * Sends a request for booth
     * @return void
     */
    public function requestBooth()
    {
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
            $this->additionalInformation = '';
            $this->requestSent = true;
            $this->company->refresh();
            session()->flash('success', 'The request has been sent successfully.');
        }
    }
}
