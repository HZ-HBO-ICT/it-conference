<?php

namespace App\Http\Livewire;

use App\Events\FinalProgrammeReleased;
use App\Models\Presentation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class ReleaseFinalProgramme extends Component
{
    public $isOpen = false;

    public $numberOfUnscheduledPresentations;

    /**
     * Triggered on initializing the component
     * @return void
     */
    public function mount()
    {
        $this->numberOfUnscheduledPresentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        })->count();
    }

    /**
     * Dispatches an event when the final programme is released
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function confirm()
    {
        FinalProgrammeReleased::dispatch();

        // I am a little baffled at this
        return redirect(request()->header('Referer'));
    }

    /**
     * Render the component
     * @return Factory|\Illuminate\Foundation\Application|View|ApplicationContract
     */
    public function render()
    {
        return view('livewire.release-final-programme');
    }
}
