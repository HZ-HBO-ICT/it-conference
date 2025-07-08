<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\Company;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Presentations extends Component
{
    public array|Collection $presentations;
    public Company $company;

    public function mount(Company $company) {
        $this->company = $company;
        $this->presentations = $this->company->presentations;
    }

    #[On('updated-dashboard')]
    public function refreshPresentations() {
        $this->company->refresh();
        $this->presentations = $this->company->presentations;
    }

    public function render()
    {
        return view('livewire.dashboards.widgets.presentations');
    }
}
