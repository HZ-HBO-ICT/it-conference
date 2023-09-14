<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarLink extends Component
{
    public $type;
    public $route;
    public $param;
    public $label;
    public string $icon;
    public string $roleColour;

    /**
     * Create a new component instance.
     */
    public function __construct($type, $route, $label, $icon, $roleColour, $param = '')
    {
        $this->route = $route;
        $this->label = $label;
        $this->icon = $icon;
        $this->roleColour = $roleColour;
        $this->param = $param;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-link');
    }
}
