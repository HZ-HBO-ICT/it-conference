<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarLink extends Component
{
    public $route;
    public $param;
    public $label;
    public string $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($route, $label, $icon,$param = '')
    {
        $this->route = $route;
        $this->label = $label;
        $this->icon = $icon;
        $this->param = $param;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-link-content-mod');
    }
}
