<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\Company;
use Livewire\Attributes\On;
use Livewire\Component;

class Status extends Component
{
    public string $status;
    public string $icon;
    public string $label;
    public string $type;
    public Company $company;

    public function mount($icon, $label, $type, $company) : void {
        $this->icon = $icon;
        $this->label = $label;
        $this->type = $type;
        $this->company = $company;

        $this->determineStatus();
    }

    #[On('updated-dashboard')]
    public function determineStatus() : void
    {
        $this->company->refresh();

        $this->status = match ($this->type) {
            'booth' => optional($this->company->booth)->approval_status ?? 'not_requested',
            'sponsorship' => $this->company->sponsorship_approval_status ?? 'not_requested',
            'company' => $this->company->approval_status ?? 'not_requested',
            default => 'unknown',
        };
    }

    public function render()
    {
        return view('livewire.dashboards.widgets.status');
    }
}
