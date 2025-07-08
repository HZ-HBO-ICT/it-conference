<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\Company;
use Livewire\Component;

class Request extends Component
{
    public string $type;
    public string $description;
    public string $class;
    public Company $company;

    public function mount(string $type, string $description, Company $company) : void {
        $this->type = $type;
        $this->description = $description;
        $this->company = $company;
    }

    public function render()
    {
        return view('livewire.dashboards.widgets.request');
    }
}
