<?php

namespace App\View\Components\Dashboards\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\Activitylog\Models\Activity;

class Log extends Component
{
    public $route;
    /**
     * Create a new component instance.
     */
    public function __construct(public Activity $activity)
    {
        $this->route = $this->getEntityRoute($this->activity->subject, $this->activity->event);
    }

    /**
     * Returns the route to the entity in the crew pages
     * @param $entity
     * @param $event
     * @return string
     */
    public function getEntityRoute($entity, $event)
    {
        if (!is_object($entity)) {
            return '#'; // Return a fallback URL or empty string if the entity is null or not an object
        }

        if ($event == 'deleted') {
            return '';
        }

        $routeMap = [
            'App\Models\Company'      => 'moderator.companies.show',
            'App\Models\Presentation' => 'moderator.presentations.show',
            'App\Models\Sponsorship'  => 'moderator.sponsorships.show',
            'App\Models\Booth'        => 'moderator.booths.show',
        ];

        $entityClass = get_class($entity);

        if (array_key_exists($entityClass, $routeMap)) {
            return route($routeMap[$entityClass], $entity);
        }

        return '#';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboards.blocks.log');
    }
}
