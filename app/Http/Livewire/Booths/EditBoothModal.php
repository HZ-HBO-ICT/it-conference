<?php

namespace App\Http\Livewire\Booths;

use App\Models\Booth;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditBoothModal extends Component
{
    public Booth $booth;

    public function render()
    {
        return view('moderator.booths.edit-booth-modal');
    }

    protected $rules = [
        'booth.width' => 'required|min:0|numeric',
        'booth.length' => 'required|min:0|numeric',
        'booth.additional_information' => ''
    ];

    public function save()
    {
        $this->validate();

        if (is_null($this->booth->additional_information)
            || $this->booth->additional_information == '')
            $this->booth->additional_information = 'No additional info';

        $this->booth->save();

        return redirect(route('moderator.booths.show', $this->booth))
            ->with('status', 'Booth successfully updated.');
    }
}
