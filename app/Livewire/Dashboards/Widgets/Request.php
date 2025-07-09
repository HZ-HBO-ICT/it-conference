<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\Company;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class Request extends Component
{
    public string $type;
    public string $description;
    public string $class;
    public Company $company;
    public User $user;

    /**
     * Initializes the component
     * @param string $type
     * @param string $description
     * @param Company $company
     * @param User $user
     * @return void
     */
    public function mount(string $type, string $description, Company $company, User $user) : void
    {
        $this->type = $type;
        $this->description = $description;
        $this->company = $company;
        $this->user = $user;
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.widgets.request');
    }
}
