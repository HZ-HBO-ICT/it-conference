<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class MemberManager extends Component
{
    public Company $company;

    /**
     * Called when initializing the component
     *
     * @param $company
     * @return void
     */
    public function mount($company)
    {
        $this->company = $company;
    }

    /**
     * Listens to an event and refreshes the component
     * @return void
     */
    #[On('user-removed')]
    public function refresh()
    {
        $this->company = $this->company->fresh();
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.company.member-manager');
    }
}
