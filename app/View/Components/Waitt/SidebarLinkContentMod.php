<?php

namespace App\View\Components\Waitt;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\This;

class SidebarLinkContentMod extends Component
{
    public $route;
    public $param;
    public $label;
    public string $icon;
    public string $roleColour;

    /**
     * Create a new component instance.
     */
    public function __construct($route, $label, $icon, $roleColour, $param = '')
    {
        $this->route = $route;
        $this->label = $label;
        $this->icon = $icon;
        $this->param = $param;
        $this->roleColour = $roleColour;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.waitt.sidebar-link-content-mod');
    }
}
