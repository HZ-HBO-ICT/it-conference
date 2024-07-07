<?php

namespace App\Livewire\Schedule;

use App\Models\Presentation;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PublishProgrammeButton extends Component
{
    public $isReadyToBePublished;
    public $oldValue;

    public $buttonClasses = "flex items-center justify-center p-3 text-sm font-semibold rounded-md focus:outline-none
    focus:ring-2 focus:ring-offset-2 focus:ring-crew-400";
    public $enabledClasses = "text-white bg-apricot-peach-500 hover:bg-apricot-peach-500";
    public $disabledClasses = "text-gray-100 bg-gray-600";
    public $iconClasses = "w-5 h-5 mr-2";


    /**
     * Initializes the component
     *
     * @return void
     */
    public function mount()
    {
        $this->isReadyToBePublished = Presentation::all()->every(function ($presentation) {
            return $presentation->isScheduled && $presentation->is_approved;
        });

        $this->oldValue = $this->isReadyToBePublished;
    }

    /**
     * Function that rechecks whether the programme is ready for release
     *
     * @return void
     */
    #[On('check-programme-status')]
    public function checkIfProgrammeisReadyForRelease()
    {
        $this->isReadyToBePublished = Presentation::all()->every(function ($presentation) {
            return $presentation->isScheduled && $presentation->is_approved;
        });

        if ($this->isReadyToBePublished && $this->isReadyToBePublished != $this->oldValue) {
            Toaster::success('The programme is ready to be
            published whenever you wish if the state remains the same.');
        }

        $this->oldValue = $this->isReadyToBePublished;
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.schedule.publish-programme-button');
    }
}
