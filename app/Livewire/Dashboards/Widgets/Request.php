<?php

namespace App\Livewire\Dashboards\Widgets;

use Livewire\Component;

class Request extends Component
{
    public string $type;
    public string $description;

    public function mount($type, $description) : void {
        $this->type = $type;
        $this->description = $description;
    }

    public function render()
    {
        return view('livewire.dashboards.widgets.request');
    }
}
