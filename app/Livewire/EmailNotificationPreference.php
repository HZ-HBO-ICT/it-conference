<?php

namespace App\Livewire;

use Livewire\Component;

class EmailNotificationPreference extends Component
{
    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('livewire.email-notification-preference');
    }
}
