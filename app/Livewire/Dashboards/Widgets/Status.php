<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\Company;
use Livewire\Component;

class Status extends Component
{
    public string $status;
    public string $icon;
    public string $label;

    public function mount($status, $icon, $label) : void {
        $this->status = $status;
        $this->icon = $icon;
        $this->label = $label;
    }

    public function render()
    {
        return view('livewire.dashboards.widgets.status');
    }
}
