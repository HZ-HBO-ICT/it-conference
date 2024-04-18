<?php

namespace App\Livewire\Helpers;

use Livewire\Component;

class SimpleDialog extends Component
{
    public string $displayText;
    public string $body;
    public string $title;

    public function mount($body, $title, $displayText)
    {
        $this->displayText = $displayText;
        $this->body = $body;
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.helpers.simple-dialog');
    }
}
