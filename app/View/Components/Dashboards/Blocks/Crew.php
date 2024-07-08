<?php

namespace App\View\Components\Dashboards\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Crew extends Component
{
    public $label;
    public $count;
    public $route;
    public $param;
    public $icon;
    public $roleColour;
    public $styleMode;
    public $selectedStyle;

    /**
     * Create a new component instance.
     */
    public function __construct($label, $count, $route, $icon, $roleColour, $param = null, $styleMode = 'default')
    {
        $this->label = $label;
        $this->count = $count;
        $this->route = $route;
        $this->param = $param;
        $this->icon = $icon;
        $this->roleColour = $roleColour;
        $this->styleMode = $styleMode;
        $this->selectedStyle = $this->determineStyle($styleMode, $roleColour);
    }

    /**
     * Determines the styling of the cards - switches the colouring
     */
    protected function determineStyle($styleMode, $roleColour)
    {
        $styles = [
            'default' => [
                'bgColor' => 'bg-white',
                'textColor' => 'text-gray-900',
                'iconColor' => 'text-' . $roleColour . '-400',
                'viewAllBgColor' => 'bg-' . $roleColour . '-300',
                'viewAllTextColor' => 'text-white',
                'viewAllBgDark' => 'bg-' . $roleColour . '-300',
                'darkMode' => 'dark:bg-gray-800',
                'darkModeText' => 'dark:text-white'
            ],
            'alternate' => [
                'bgColor' => 'bg-' . $roleColour . '-300',
                'textColor' => 'text-white',
                'iconColor' => '',
                'viewAllBgColor' => 'bg-white',
                'viewAllTextColor' => 'text-' . $roleColour . '-300',
                'viewAllBgDark' => 'dark:bg-gray-800',
                'darkMode' => 'dark:bg-' . $roleColour . '-300',
                'darkModeText' => 'dark:text-white',
            ]
        ];

        return $styles[$styleMode] ?? $styles['default'];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboards.blocks.crew', [
            'selectedStyle' => $this->selectedStyle,
        ]);
    }
}
