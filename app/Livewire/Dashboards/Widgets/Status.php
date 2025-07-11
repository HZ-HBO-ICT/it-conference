<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\Company;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Status extends Component
{
    public string $status;
    public string $icon;
    public string $label;
    public string $type;
    public Company $company;

    /**
     * Initializes the component
     * @param string $icon
     * @param string $label
     * @param string $type
     * @param Company $company
     * @return void
     */
    public function mount(string $icon, string $label, string $type, Company $company) : void
    {
        $this->icon = $icon;
        $this->label = $label;
        $this->type = $type;
        $this->company = $company;

        $this->determineStatus();
    }

    /**
     * Determines which status the component should follow
     * @return void
     */
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

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.widgets.status');
    }
}
