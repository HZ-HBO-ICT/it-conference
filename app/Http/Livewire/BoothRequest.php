<?php

namespace App\Http\Livewire;

use App\Models\Booth;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BoothRequest extends Component
{
    public $team;
    public $additionalInformation;
    public $requestSent;


    /**
     * @param $team
     * @return void
     */
    public function mount($team): void
    {
        $this->team = $team;

        $this->requestSent = $this->team->booth ? true : false;
    }

    /**
     * Displays the livewire booth-request element.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.booth-request');
    }

    /**
     * TODO: Unused function
     * Sends a request for a booth.
     * @return void
     */
    public function requestBooth(): void
    {
        if (!$this->team->booth) {
            Booth::create(
                [
                    'width' => 3,
                    'length' => 3,
                    'additional_information' => is_null($this->additionalInformation) ? 'No additional demands' : $this->additionalInformation,
                    'team_id' => $this->team->id
                ]
            );

            $this->additionalInformation = '';
            $this->requestSent = true;
            $this->team->refresh();
            session()->flash('success', 'The request has been sent successfully.');
        }
    }
}
