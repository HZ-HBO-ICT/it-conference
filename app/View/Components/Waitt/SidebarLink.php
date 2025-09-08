<?php

namespace App\View\Components\Waitt;

use App\Models\Presentation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SidebarLink extends Component
{
    public string $type;
    public string $route;
    /** @phpstan-ignore-next-line */
    public $param;
    public string $label;
    public string $icon;
    public string $roleColour;

    /**
     * Create a new component instance.
     */
    /** @phpstan-ignore-next-line */
    public function __construct(string $type, string $route, string $label, string $icon, string $roleColour, $param = '')
    {
        $this->route = $route;
        $this->param = $param;
        $this->label = empty($label) && $param instanceof Presentation ? $this->determineLabelLength() : $label;
        $this->icon = $icon;
        $this->roleColour = $roleColour;
        $this->type = $type;
    }

    /**
     * Determine how long should the label be
     * so that it stays on one line in the side menu
     *
     * @return string
     */
    public function determineLabelLength(): string
    {
        return strlen('View ' . $this->param->name) > 20 ?
            substr('View ' . $this->param->name, 0, 20) . '...'
            : 'View ' . $this->param->name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.waitt.sidebar-link');
    }
}
