<?php

namespace App\Livewire\Schedule;

use App\Enums\ApprovalStatus;
use App\Models\Presentation;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PublishProgrammeButton extends Component
{
    public $isReadyToBePublished;
    public $allPresentationsAreApproved;
    public $allPresentationsAreScheduled;
    public $oldValue;

    public $buttonClasses = "flex items-center justify-center p-3 text-sm font-semibold rounded-md focus:outline-none
    focus:ring-2 focus:ring-offset-2 focus:ring-crew-400";
    public $enabledClasses = "text-emerald-400 border border-emerald-400 hover:border-waitt-pink hover:text-waitt-pink hover:cursor-pointer transition";
    public $disabledClasses = "text-gray-400 border border-gray-400";
    public $iconClasses = "w-5 h-5 mr-2";


    /**
     * Initializes the component
     *
     * @return void
     */
    public function mount()
    {
        $this->allPresentationsAreApproved = Presentation::all()->every(function ($presentation) {
            return $presentation->is_approved;
        });
        $this->allPresentationsAreScheduled = Presentation::hasStatus(ApprovalStatus::APPROVED)
            ->get()
            ->every(function ($presentation) {
                return $presentation->isScheduled;
            });

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
        $this->allPresentationsAreApproved = Presentation::all()->every(function ($presentation) {
            return $presentation->is_approved;
        });
        $this->allPresentationsAreScheduled = Presentation::hasStatus(ApprovalStatus::APPROVED)
            ->get()
            ->every(function ($presentation) {
                return $presentation->isScheduled;
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
