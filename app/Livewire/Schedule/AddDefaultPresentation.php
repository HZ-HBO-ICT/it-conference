<?php

namespace App\Livewire\Schedule;

use App\Livewire\Forms\DefaultPresentationForm;
use App\Models\Room;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AddDefaultPresentation extends ModalComponent
{
    public $type;
    public $rooms;
    public DefaultPresentationForm $form;

    public function mount($type)
    {
        $this->type = $type;
        $this->rooms = Room::all();
        $this->form->setType($this->type);
    }

    public function save()
    {
        $this->form->save();

        if($this->form->isEntityCreated()){
            return redirect(route('moderator.schedule.index'))
                ->with('status', ucfirst($this->type) . ' is successfully added.');
        }
    }

    public function render()
    {
        return view('livewire.schedule.add-default-presentation');
    }
}
