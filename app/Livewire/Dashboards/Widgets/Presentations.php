<?php

namespace App\Livewire\Dashboards\Widgets;

use Illuminate\Support\Collection;
use Livewire\Component;

class Presentations extends Component
{
    public array|Collection $presentations;

    public function mount($presentations) {
        $this->presentations = $presentations;
    }

    public function render()
    {
        return view('livewire.dashboards.widgets.presentations');
    }
}
