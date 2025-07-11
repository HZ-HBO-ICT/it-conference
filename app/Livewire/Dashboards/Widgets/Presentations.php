<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\Company;
use App\Models\Presentation;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Presentations extends Component
{
    /** @var Collection<int, Presentation> */
    public $presentations;
    public Company $company;

    /**
     * Initializes the component
     * @param Company $company
     * @return void
     */
    public function mount(Company $company) : void
    {
        $this->company = $company;
        $this->presentations = $this->company->presentations;
    }

    /**
     * Refreshes the content of the widget
     * @return void
     */
    #[On('updated-dashboard')]
    public function refreshPresentations() : void
    {
        $this->company->refresh();
        $this->presentations = $this->company->presentations;
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.widgets.presentations');
    }
}
