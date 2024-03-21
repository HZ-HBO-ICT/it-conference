<?php

namespace App\Http\Livewire\Booths;

use App\Models\Booth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Livewire\Component;
use Symfony\Component\Console\Application;

class EditBoothModal extends Component
{
    public Booth $booth;

    /**
     * Renders the component
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render()
    {
        return view('moderator.booths.edit-booth-modal');
    }

    protected $rules = [
        'booth.width' => 'required|min:0|numeric',
        'booth.length' => 'required|min:0|numeric',
        'booth.additional_information' => ''
    ];


    /**
     * Saves the changes made on the booth
     * @return RedirectResponse
     */
    public function save() : RedirectResponse
    {
        $this->validate();

        if (is_null($this->booth->additional_information)
            || $this->booth->additional_information == '') {
            $this->booth->additional_information = 'No additional info';
        }

        $this->booth->save();

        return redirect(route('moderator.booths.show', $this->booth))
            ->with('status', 'Booth successfully updated.');
    }
}
