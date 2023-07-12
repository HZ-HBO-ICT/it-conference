<?php

namespace App\Http\Livewire;

use App\Models\Booth;
use Livewire\Component;

class BoothRequest extends Component
{
    public $team;
    public $additionalInformation;
    public $requestSent;


    public function mount($team)
    {
        $this->team = $team;

        $this->requestSent = $this->team->booth ? true : false;
    }

    public function render()
    {
        return view('livewire.booth-request');
    }

    public function requestBooth()
    {
        if (!$this->team->booth) {
            Booth::create(
                [
                    'width' => 3,
                    'length' => 3,
                    'additional_information' => is_null($this->additionalInformation) ? 'No additional demands' : $this->additionalInformation,
                    'team_id' => $this->team->id
                ]);

            $this->additionalInformation = '';
            $this->requestSent = true;
            $this->team->refresh();
            session()->flash('success', 'The request has been sent successfully.');
        }
    }
}
