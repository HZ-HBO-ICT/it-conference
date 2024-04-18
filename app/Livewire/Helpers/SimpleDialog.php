<?php

namespace App\Livewire\Helpers;

use Illuminate\View\View;
use Livewire\Component;

class SimpleDialog extends Component
{
    public string $displayText;
    public string $body;
    public string $title;

    /**
     * Initializes the component
     * @param $body
     * @param $title
     * @param $displayText
     * @return void
     */
    public function mount($body, $title, $displayText)
    {
        $this->displayText = $displayText;
        $this->body = $body;
        $this->title = $title;
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.helpers.simple-dialog');
    }
}
