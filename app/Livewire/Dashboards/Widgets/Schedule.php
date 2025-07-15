<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\Edition;
use App\Models\Presentation;
use App\Models\Timeslot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

/**
 * Implementation inspiration
 * https://dev.to/crayoncode/building-a-vertical-calendar-with-html-css-js-2po2
 */
class Schedule extends Component
{
    /** @var array<array<string, int|string>|string> */
    public array $timeslots = [];
    /** @var Collection<int, Presentation> */
    public $presentations;
    public User $user;
    public int $startHour;
    public int $endHour;
    public Edition|null $edition;

    /**
     * Initializes the component
     * @param User $user
     * @param int $startHour
     * @param int $endHour
     * @return void
     */
    public function mount(User $user, int $startHour, int $endHour) : void
    {
        $this->generateTimeslots();
        $this->user = $user;
        $this->presentations = $user->participating_in->merge($user->presenter_of ? collect([$user->presenter_of]) : []);
        $this->startHour = $startHour;
        $this->endHour = $endHour;
        $this->edition = Edition::current();
    }

    /**
     * Generate timeslots for within the view
     * @return void
     */
    public function generateTimeslots()
    {
        $this->timeslots = [];
        for ($hour = $this->startHour; $hour <= $this->endHour; $hour++) {
            $this->timeslots[] = [
                'time' => sprintf('%02d:00', $hour),
                'hour' => $hour
            ];
        }
    }

    /**
     * Calculates where the presentation should be displayed at
     * @param Presentation $presentation
     * @return string[]
     */
    public function getPresentationPosition(Presentation $presentation)
    {
        $startTime = Carbon::parse($presentation->start);
        $endTime = $startTime->copy()->addMinutes($presentation->presentationType->duration);

        $startHour = $startTime->hour;
        $startMinute = $startTime->minute;
        $endHour = $endTime->hour;
        $endMinute = $endTime->minute;

        $top = (($startHour - $this->startHour) * 60) + ($startMinute * 1);
        $height = (($endHour - $startHour) * 60) + (($endMinute - $startMinute) * 1);

        return [
            'top' => $top . 'px',
            'height' => $height . 'px'
        ];
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.widgets.schedule');
    }
}
