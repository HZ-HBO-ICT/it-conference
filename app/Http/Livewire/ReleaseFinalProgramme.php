<?php

namespace App\Http\Livewire;

use App\Events\FinalProgrammeReleased;
use App\Models\Presentation;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Livewire\Component;

class ReleaseFinalProgramme extends Component
{
    public $isOpen = false;

    public $numberOfUnscheduledPresentations;

    /**
     * @return void
     */
    public function mount()
    {
        $this->numberOfUnscheduledPresentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        })->count();
    }

    /**
     * Redirects the user after confirming.
     * @return Redirector
     */
    public function confirm(): Redirector
    {
        FinalProgrammeReleased::dispatch();
        return redirect(request()->header('Referer'));
    }

    /**
     * Renders the final-programme element.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.release-final-programme');
    }
}
